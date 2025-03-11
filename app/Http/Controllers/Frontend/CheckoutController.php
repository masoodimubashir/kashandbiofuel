<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Transaction;
use App\Service\PhonepeService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CheckoutController extends Controller
{
  private $phonepeService;
  private const TOKEN_ENDPOINT = 'https://api-preprod.phonepe.com/apis/pg-sandbox/v1/oauth/token';
  private const PAYMENT_ENDPOINT = 'https://api-preprod.phonepe.com/apis/pg-sandbox/checkout/v2/pay';
  private const STATUS_ENDPOINT = 'https://api-preprod.phonepe.com/apis/pg-sandbox/checkout/v2/order/';

  public function __construct(PhonepeService $phonepeService)
  {
    $this->phonepeService = $phonepeService;
  }

  public function index(Request $request)
  {
    $address = Address::where('user_id', auth()->user()->id)->first();

    if ($request->ajax()) {
      $cart_data = $request->cart_data;
      $cart_ids = collect($cart_data)->pluck('cart_id')->toArray();
      $checkout_price = $request->checkout_price;

      $cart_items = Cart::with(['product' => fn($query) => $query->with('productAttributes')])
        ->whereIn('id', $cart_ids)
        ->get();

      return response()->json([
        'message' => 'Cart items fetched successfully',
        'cart_items' => $cart_items,
        'checkout_price' => (int)$checkout_price,
        'cart_data' => $cart_data,
        'status' => true
      ]);
    }

    return view('frontend.Checkout.checkout', compact('address'));
  }


  public function initiatePayment(Request $request)
  {
    try {


      $accessToken = $this->validateToken();

      $merchantOrderId = uniqid('TX');

      $payload = [
        "merchantOrderId" => $merchantOrderId,
        "amount" => $request->total_price * 100,
        "expireAfter" => 1200,
        "metaInfo" => [
          "udf1" => "Order payment",
          "udf2" => json_encode($request->cart_data),
          'udf3' => $request->address_id,
        ],
        "paymentFlow" => [
          "type" => "PG_CHECKOUT",
          "message" => "Payment for order",
          "merchantUrls" => [
            "redirectUrl" => route('payment.redirect', $merchantOrderId)
          ]
        ]
      ];


      $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'O-Bearer ' . $accessToken
      ])->post(self::PAYMENT_ENDPOINT, $payload);

      $responseData = $response->json();


      if (isset($responseData['redirectUrl'])) {
        session(['current_order_id' => $merchantOrderId]);

        return response()->json([
          'status' => true,
          'redirect_url' => $responseData['redirectUrl'],
          'order_id' => $responseData['orderId']
        ]);
      }

      throw new Exception('Invalid payment response');
    } catch (Exception $e) {
      return response()->json([
        'status' => false,
        'message' => 'Payment initialization failed',
        'error' => $e->getMessage()
      ], 500);
    }
  }

  private function getAccessToken()
  {
    try {

      $response = Http::withHeaders([
        'Content-Type' => 'application/x-www-form-urlencoded'
      ])->asForm()->post(self::TOKEN_ENDPOINT, [
        'client_id' => config('services.phonePe.client_id'),
        'client_version' => 1,
        'client_secret' => config('services.phonePe.client_secret'),
        'grant_type' => 'client_credentials'
      ]);


      $tokenData = $response->json();


      if (!isset($tokenData['access_token'])) {
        throw new Exception('Invalid token response');
      }

      session([
        'phonepe_token' => $tokenData['access_token'],
        'token_expires_at' => $tokenData['expires_at']
      ]);

      return $tokenData['access_token'];
    } catch (Exception $e) {
      Log::error('PhonePe Token Error: ' . $e->getMessage());
      throw $e;
    }
  }

  private function validateToken()
  {
    $expiresAt = session('token_expires_at');
    return (!$expiresAt || Carbon::now()->timestamp >= $expiresAt)
      ? $this->getAccessToken()
      : session('phonepe_token');
  }



  public function checkOrderStatus(Request $request,$merchantOrderId)
  {

    try {

      // dd($request->all());

      $accessToken = $this->validateToken();

      $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'O-Bearer ' . $accessToken
      ])->get(self::STATUS_ENDPOINT . $merchantOrderId . '/status');

      $orderData = $response->json();

      return match ($orderData['state']) {
        'COMPLETED' => $this->handleCompletedPayment($orderData),
        'PENDING' => $this->handlePendingPayment($orderData),
        'FAILED' => $this->handleFailedPayment($orderData),
        default => throw new Exception('Invalid payment state received')
      };
    } catch (Exception $e) {
      return [
        'status' => false,
        'message' => 'Failed to check payment status',
        'error' => $e->getMessage()
      ];
    }
  }

  private function handleCompletedPayment($orderData)
  {


    $data = $this->phonepeService->processSuccessfulPayment($orderData);


    return view('frontend.Order.order-confirmation', compact('data'));
  }

  private function handlePendingPayment($orderData)
  {

    dd('pending');

    return [
      'status' => 'pending',
      'message' => 'Payment is being processed',
      'data' => $orderData,
      'expires_at' => $orderData['expireAt']
    ];
  }

  private function handleFailedPayment($orderData): array
  {

    dd('failed');

    return [
      'status' => false,
      'message' => 'Payment failed',
      'data' => $orderData,
      'transaction' => $transaction
    ];
  }
}
