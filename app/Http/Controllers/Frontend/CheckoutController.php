<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Transaction;
use App\Service\PhonepeService;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{


  private $phonepeService;

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


  public function getPhonePeToken()
  {
      $response = Http::asForm()->post('https://api-preprod.phonepe.com/apis/pg-sandbox/v1/oauth/token', [
          'client_id' => 'KASSHUATCRED_2503071644501134412447',
          'client_version' => 1,
          'client_secret' => 'YWQwYjEzYzQtYTVhZS00OGYyLWFiMGQtNTdlMjhjOWVjNmIy',
          'grant_type' => 'client_credentials'
      ]);
  
      return $response->json();
  }
  
  public function checkout(Request $request)
  {
      try {
          $payload = [
              'merchantId' => 'SU2503061711515453461035',
              'merchantTransactionId' => uniqid('txn_'),
              'merchantUserId' => auth()->user()->id,
              'amount' => 1 * 100,
              'redirectUrl' => route('payment.redirect'),
              'callbackUrl' => route('payment.callback'),
              'paymentInstrument' => [
                  'type' => 'PAY_PAGE',
              ],
          ];
  
          $payloadJson = json_encode($payload);
          $base64EncodedPayload = base64_encode($payloadJson);
          
          $endpoint = '/pg/v2/pay';
          $saltKey = 'df71db3d-c393-4412-9a1d-60b0990d675c';
          $saltIndex = 1;
  
          $stringToHash = $base64EncodedPayload . $endpoint . $saltKey;
          $checksum = hash('sha256', $stringToHash);
          $xVerify = $checksum . '###' . $saltIndex;
  
          $response = Http::withHeaders([
              'X-VERIFY' => $xVerify,
              'Content-Type' => 'application/json'
          ])->post('https://api.phonepe.com/apis/pg/checkout/v2/pay', [
              'request' => $base64EncodedPayload
          ]);
  
          $responseData = $response->json();
  
          if (isset($responseData['data']['instrumentResponse']['redirectInfo']['url'])) {
              return response()->json([
                  'success' => true, 
                  'redirect_url' => $responseData['data']['instrumentResponse']['redirectInfo']['url']
              ]);
          }
  
          Log::error('PhonePe API Invalid Response', ['response' => $responseData]);
          return response()->json([
              'success' => false,
              'message' => 'Failed to obtain redirect URL'
          ]);
  
      } catch (Exception $e) {
          Log::error('PhonePe Payment Error: ' . $e->getMessage());
          return response()->json([
              'success' => false,
              'message' => 'Failed to process payment',
              'error' => $e->getMessage()
          ], 500);
      }
  }
  


  public function callback(Request $request)
  {

    session(['data' => 'test']);

    Log::info('Callback request received');

    dd($request->all());
  }

  public function redirect(Request $request)
  {

    dd($request->all());
    return view('frontend.Order.order-confirmation');
  }

  public function cashOnDelivery(StoreOrderRequest $request)
  {

    try {

      if ($request->ajax()) {

        $response = $this->phonepeService->checkout($request->validated());

        return response()->json([
          'status' => $response['status'],
          'payment_method' => $response['payment_method'],
          'message' => $response['message'],
          'transaction_id' => $response['transaction_id'],
          'redirect_url' => $response['redirect_url'],
        ]);
      }
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
        'error' => 'Failed to process cash on delivery payment'
      ]);
    }
  }


  public function orderPlaced($transaction_id)
  {

    $transaction = Transaction::query()
      ->with([
        'order' => fn($query) => $query->with([
          'address',
          'orderedItems' => fn($query) => $query->with([
            'product' => fn($query) => $query->with('productAttributes')
          ])
        ])->withCount('orderedItems')
      ])
      ->where('transaction_id', $transaction_id)->first();


    return view('frontend.Order.order-confirmation', compact('transaction'));
  }
}
