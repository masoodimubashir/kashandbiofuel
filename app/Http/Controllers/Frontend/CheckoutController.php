<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
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
        try {

            $redirectUrl = $this->phonepeService->checkout($request);


            return response()->json([
                'status' => true,
                'message' => 'Payment initiated successfully',
                'redirect_url' => $redirectUrl,
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Payment initiation failed: ' . $e->getMessage(),
            ], 500);
        }
    }

//    public function callback(Request $request)
//    {
//        try {
//
//            $this->phonepeService->createOrder();
//
//            return response()->json(['status' => true, 'message' => 'Payment verified successfully'], 200);
//
//        } catch (Exception $e) {
//            Log::error('Callback Error: ' . $e->getMessage());
//            return response()->json(['status' => false, 'message' => 'Payment verification failed'], 500);
//        }
//    }

    public function redirect(Request $request)
    {
        try {


            $this->phonepeService->handlePaymentResponse();

            return view('frontend.Order.order-confirmation');


        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve cart items: ' . $e->getMessage(),
            ], 500);
        }

    }
}
