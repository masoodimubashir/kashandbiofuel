<?php

namespace App\Http\Controllers\Frontend;

use App\Class\PhonePeHelper;
use App\Http\Controllers\Controller;
use App\Models\{Address, Cart, Transaction};
use App\Models\Refund;
use App\Service\PhonepeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Exception;

class CheckoutController extends Controller
{
  private $phonepeService;
  private $phonePeHelper;

  public function __construct(PhonepeService $phonepeService, PhonePeHelper $phonePeHelper)
  {
    $this->phonepeService = $phonepeService;
    $this->phonePeHelper = $phonePeHelper;
  }

  public function index(Request $request): View|JsonResponse
  {
    if ($request->ajax()) {
      return $this->handleAjaxRequest($request);
    }

    $address = Address::where('user_id', auth()->user()->id)->first();
    return view('frontend.Checkout.checkout', compact('address'));
  }

  private function handleAjaxRequest(Request $request): JsonResponse
  {
    $cart_ids = collect($request->cart_data)->pluck('cart_id')->toArray();

    $cart_items = Cart::with(['product' => fn($query) => $query->with('productAttributes')])
      ->whereIn('id', $cart_ids)
      ->get();

    return response()->json([
      'message' => 'Cart items fetched successfully',
      'cart_items' => $cart_items,
      'checkout_price' => (int)$request->checkout_price,
      'cart_data' => $request->cart_data,
      'status' => true
    ]);
  }

  public function initiatePayment(Request $request): JsonResponse
  {
    try {

      $accessToken = $this->phonePeHelper->validateToken();
      $merchantOrderId = uniqid('TX');
      $payload = $this->buildPaymentPayload($request, $merchantOrderId);

      $response = $this->phonePeHelper->makePaymentRequest($accessToken, $payload);

      if (isset($response['redirectUrl'])) {
        session(['current_order_id' => $merchantOrderId]);

        return response()->json([
          'status' => true,
          'redirect_url' => $response['redirectUrl']
        ]);
      }

      throw new Exception('Invalid payment response');
    } catch (Exception $e) {
      return response()->json($this->phonePeHelper->formatErrorResponse($e->getMessage()), 500);
    }
  }

  private function buildPaymentPayload(Request $request, string $merchantOrderId): array
  {

    return [
      "merchantOrderId" => $merchantOrderId,
      "amount" => 1 * 100,
      "metaInfo" => [
        "udf1" => "Order payment",
        "udf2" => json_encode($request->cart_data),
        'udf3' => $request->address_id,
        'udf4' => $merchantOrderId,
      ],
      "paymentFlow" => [
        "type" => "PG_CHECKOUT",
        "message" => "Payment for order",
        "merchantUrls" => [
          "redirectUrl" => route('payment.redirect', $merchantOrderId)
        ]
      ]
    ];
  }

  public function checkOrderStatus(string $merchantOrderId): View|array
  {

    try {
      $accessToken = $this->phonePeHelper->validateToken();

      $orderData = $this->phonePeHelper->fetchOrderStatus($accessToken, $merchantOrderId);

      return $this->handleOrderStatus($orderData);

    } catch (Exception $e) {
      Log::error('Order Status Check Error: ' . $e->getMessage());
      return $this->phonePeHelper->formatErrorResponse('Failed to check payment status');
    }
  }

  private function handleOrderStatus(array $orderData): View|array
  {
    return match ($orderData['state']) {
      'COMPLETED' => $this->handleCompletedPayment($orderData),
      'PENDING' => $this->handlePendingPayment($orderData),
      'FAILED' => $this->handleFailedPayment(),
      default => throw new Exception('Invalid payment state received')
    };
  }

  private function handleCompletedPayment(array $orderData): View
  {
    $data = $this->phonepeService->processSuccessfulPayment($orderData);
    return view('frontend.Order.order-confirmation', [
      'transaction' => $data['transaction'],
      'order' => $data['order']
    ]);
  }

  private function handlePendingPayment(array $orderData): array
  {
    return [
      'status' => 'pending',
      'message' => 'Payment is being processed',
      'data' => $orderData,
      'expires_at' => $orderData['expireAt']
    ];
  }

  private function handleFailedPayment(): View
  {
    return view('frontend.Order.order-failed');
  }

  public function refund(string $txn_id): View|array
  {
    try {

      $transaction = Transaction::with('order')
        ->where('transaction_id', $txn_id)
        ->firstOrFail();

      $accessToken = $this->phonePeHelper->validateToken();

      $refundData = $this->buildRefundPayload($transaction);

      $response = $this->phonePeHelper->initiateRefundRequest($accessToken, $refundData);

      if ($response->successful()) {

        $this->createRefund($response->json(), $transaction, $refundData);

        $refundresponse = $this->phonePeHelper->fetchRefundStatus($accessToken, $refundData['merchantRefundId']);

        $transaction->order->update([
          'is_cancelled' => 1,
        ]);

        return view('frontend.Order.refund-confirmation', compact('refundresponse', 'transaction'));
      }

      return $this->phonePeHelper->formatErrorResponse('Failed to initiate refund', $response->json());
    } catch (Exception $e) {
      Log::error('Refund Error: ' . $e->getMessage());
      return $this->phonePeHelper->formatErrorResponse('Error processing refund');
    }
  }

  private function buildRefundPayload(Transaction $transaction): array
  {
    return [
      'merchantRefundId' => 'REF-' . uniqid(),
      'originalMerchantOrderId' => $transaction->transaction_id,
      'amount' => $transaction->order->total_amount * 100,
    ];
  }

  public function checkRefundStatus(string $merchantRefundId): array
  {
    try {
      $accessToken = $this->phonePeHelper->validateToken();
      $refundData = $this->phonePeHelper->fetchRefundStatus($accessToken, $merchantRefundId);
      return $this->processRefundStatus($refundData);
    } catch (Exception $e) {
      Log::error('PhonePe Refund Status Check Error: ' . $e->getMessage());
      return $this->phonePeHelper->formatErrorResponse('Failed to check refund status');
    }
  }

  private function processRefundStatus(array $refundData): array
  {
    $handlers = [
      'COMPLETED' => fn() => $this->handleCompletedRefund($refundData),
      'PENDING' => fn() => $this->handlePendingRefund($refundData),
      'FAILED' => fn() => $this->handleFailedRefund($refundData)
    ];

    return $handlers[$refundData['state']]() ?? [
      'status' => false,
      'message' => 'Invalid refund state received'
    ];
  }

  private function handleCompletedRefund(array $refundData): array
  {
    return [
      'status' => true,
      'message' => 'Refund completed successfully',
      'data' => [
        'refund_id' => $refundData['refundId'],
        'amount' => $refundData['amount'],
        'original_order_id' => $refundData['originalMerchantOrderId'],
        'timestamp' => Carbon::createFromTimestamp($refundData['timestamp'] / 1000),
        'transaction_details' => $refundData['splitInstruments']
      ]
    ];
  }

  private function handlePendingRefund(array $refundData): array
  {
    return [
      'status' => true,
      'message' => 'Refund is being processed',
      'data' => [
        'refund_id' => $refundData['refundId'],
        'amount' => $refundData['amount'],
        'timestamp' => Carbon::createFromTimestamp($refundData['timestamp'] / 1000)
      ]
    ];
  }

  private function handleFailedRefund(array $refundData): array
  {
    return [
      'status' => false,
      'message' => 'Refund failed',
      'error' => [
        'code' => $refundData['errorCode'],
        'detailed_code' => $refundData['detailedErrorCode']
      ]
    ];
  }


  private function createRefund($refundPayload, $transaction, $refundData)
  {

    $refund = new Refund();
    $refund->order_id = $transaction->order->id; 
    $refund->transaction_id = $transaction->id; 
    $refund->refund_id = $refundData['merchantRefundId']; 
    $refund->amount = $transaction->amount; 
    $refund->status = $refundPayload['state']; 
    $refund->phonepe_refund_id = $refundPayload['refundId']; 
    $refund->refund_initiated_at = now(); 
    $refund->save();

    return $refund;
  }
}
