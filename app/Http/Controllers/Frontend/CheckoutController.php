<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Transaction;
use App\Service\PhonepeService;
use Exception;
use Illuminate\Http\Request;
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

            $cart_ids = explode(',', $request->query('cart_ids'));

            $checkout_price = $request->query('total_price');

            $cart_items = Cart::with(['product' => fn($query) => $query->with('productAttribute')])
                ->whereIn('id', $cart_ids)->get();

            return response()->json([
                'message' => 'Cart items fetched successfully',
                'cart_items' => $cart_items,
                'checkout_price' => (int)$checkout_price,
                'status' => true,
            ]);
        }


        return view('frontend.Checkout.checkout', compact('address'));
    }

    public function checkout(Request $request)
    {


        $payload = [
            "merchantId" => config('services.phonePe.merchantId'),
            "merchantTransactionId" => uniqid('txn_'),
            "merchantUserId" => auth()->user()->id,
            "amount" => $request->total_price * 100,
            "redirectUrl" => route('payment.redirect'),
            'redirectMode'=>"POST",
            "callbackUrl" => route('payment.callback'),
            "mobileNumber" => auth()->user()->address()->first()->phone,
            "paymentInstrument" => [
                "type" => "PAY_PAGE"
            ]
        ];

        $payloadJson = json_encode($payload);
        $base64EncodedPayload = base64_encode($payloadJson);

        $endpoint = '/pg/v1/pay';
        $saltKey = config('services.phonePe.salt_key');
        $saltIndex = 1;

        $stringToHash = $base64EncodedPayload . $endpoint . $saltKey;
        $checksum = hash('sha256', $stringToHash);

        $xVerify = $checksum . '###' . $saltIndex;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['request' => $base64EncodedPayload]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-VERIFY: ' . $xVerify,
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            Log::error('cURL Error', ['error' => curl_error($ch)]);
            curl_close($ch);
            return response()->json([
                'success' => false,
                'message' => 'Failed to initiate payment.',
            ]);
        }

        curl_close($ch);

        $responseData = json_decode($response, true);

        if (isset($responseData['data']['instrumentResponse']['redirectInfo']['url'])) {
            $redirectUrl = $responseData['data']['instrumentResponse']['redirectInfo']['url'];
            return response()->json(['status' => true, 'redirect_url' => $redirectUrl]);
        } else {
            Log::error('PhonePe API Invalid Response', ['response' => $responseData]);
            // return response()->json(['status' => false, 'message' => 'Failed to obtain redirect URL.']);
        }
    }

    public function callback(Request $request)
    {
       Log::info('Callback request received');
    }

    public function redirect(Request $request)
    {
        return view('frontend.Order.order-confirmation');
    }
}
