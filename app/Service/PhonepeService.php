<?php

namespace App\Service;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wishlist;
use App\Notifications\OrderNotification;
use App\Repository\CartRepository;
use DB;
use Exception;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PhonepeService
{
    private CartRepository $repository;

    public function __construct(CartRepository $repository)
    {
        $this->repository = $repository;
    }

    public function checkout($request)
    {

        try {
            return $request['payment_method'] === 'online'
                ? $this->payOnline($request)
                : $this->payOffline($request);
        } catch (Exception $e) {
            Log::error('Checkout Error: ' . $e->getMessage());
            throw new HttpException(500, 'Payment processing failed: ' . $e->getMessage());
        }
    }

    public function payOffline($request): array
    {
        try {

            DB::beginTransaction();

            $merchantTransactionId = uniqid('txn_');
            $amount = $request['total_price'];
            $status = 1;
            $payment_method = $request['payment_method'];

            $transaction = $this->makeTransaction(
                $merchantTransactionId,
                $status,
                $amount,
                $payment_method
            );


            $order = $this->createOrder($request, $transaction);

            $this->sendOrderNotification($order);

            DB::commit();

            return [
                'status' => true,
                'order' => $order,
                'message' => 'Order placed successfully',
                'transaction_id' => $transaction->id,
                'payment_method' => $payment_method,
                'redirect_url' => route('checkout.order-placed', ['transaction_id' => $transaction->transaction_id])
            ];
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Offline Payment Error: ' . $e->getMessage());
            throw new HttpException(500, 'Failed to process offline payment: ' . $e->getMessage());
        }
    }

    private function payOnline($request)
    {
        try {

            $payload = $this->generatePayload($request['amount']);
            $headers = $this->generateHeaders($payload);

            $response = Http::withHeaders($headers)->post(
                'https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay',
                ['request' => $payload]
            );

            if (!$response->successful()) {
                throw new Exception('PhonePe API request failed');
            }

            $responseData = $response->json();

            if (empty($responseData['data']['instrumentResponse']['redirectInfo']['url'])) {
                throw new Exception('Invalid PhonePe API response');
            }


            DB::beginTransaction();

            $this->makeTransaction($responseData['data']['merchantTransactionId'], $request, 0);

            DB::commit();

            return [
                'success' => true,
                'redirect_url' => $responseData['data']['instrumentResponse']['redirectInfo']['url']
            ];
        } catch (Exception $e) {


            DB::rollBack();
            Log::error('Online Payment Error: ' . $e->getMessage());
            throw new HttpException(500, 'Failed to initiate online payment: ' . $e->getMessage());
        }
    }

    public function handlePaymentResponse($request)
    {
        try {

            DB::beginTransaction();

            $merchantTransactionId = session()->pull('merchantTransactionId');
            $paymentStatus = $this->verifyPaymentStatus($merchantTransactionId);

            if (!$paymentStatus['success']) {
                throw new Exception('Payment verification failed');
            }

            $transaction = Transaction::where('transaction_id', $merchantTransactionId)->firstOrFail();
            $transaction->update(['status' => 1]);

            $order = $this->createOrder($request, $transaction, 'online');

            DB::commit();

            return [
                'success' => true,
                'order' => $order,
                'message' => 'Payment successful and order created'
            ];
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Payment Response Error: ' . $e->getMessage());
            throw new HttpException(500, 'Error processing payment response: ' . $e->getMessage());
        }
    }

    private function verifyPaymentStatus($merchantTransactionId)
    {
        // Add your PhonePe payment status verification logic here
        $endpoint = "/pg/v1/status/{$merchantTransactionId}";
        $saltKey = config('services.phonePe.salt_key');
        $saltIndex = 1;

        $checksum = hash('sha256', $endpoint . $saltKey);
        $xVerify = $checksum . '###' . $saltIndex;

        $response = Http::withHeaders([
            'X-VERIFY' => $xVerify,
            'X-MERCHANT-ID' => config('services.phonePe.merchantId'),
            'Content-Type' => 'application/json',
        ])->get("https://api-preprod.phonepe.com/apis/pg-sandbox{$endpoint}");


        if ($response->successful()) {
            $data = $response->json();
            return [
                'success' => $data['code'] === 'PAYMENT_SUCCESS',
                'data' => $data
            ];
        }

        return ['success' => false];
    }

    private function makeTransaction($merchantTransactionId, $status, $amount, $payment_method)
    {
        return Transaction::create([
            'user_id' => auth()->user()->id,
            'amount' => $amount,
            'status' => $status,
            'payment_method' => $payment_method,
            'transaction_id' => $merchantTransactionId,
        ]);
    }

    private function createOrder($request, $transaction)
    {
        // Get cart items from the request data
        $cartData = $request['cart_data'];
        
        if (empty($cartData)) {
            throw new Exception('Cart is empty');
        }
    
        $order = Order::create([
            'user_id' => $transaction->user_id,
            'custom_order_id' => uniqid('cus_'),
            'address_id' => $request['address_id'],
            'total_amount' => $transaction->amount,
            'date_of_purchase' => now(),
            'transaction_id' => $transaction->id,
            'payment_method' => $request['payment_method'],
        ]);
    
        // Process each cart item
        foreach ($cartData as $item) {
            // Get the cart item details
            $cartItem = Cart::findOrFail($item['cart_id']);
            $product = Product::findOrFail($cartItem->product_id);


            
            Wishlist::where('product_id', $product->id)
                    ->where('user_id', $transaction->user_id)
                    ->delete();

    
            // Create order item
            $this->createOrderItem([
                'product_id' => $product->id,
                'product_attribute_id' => $item['product_attribute_id'],
                'qty' => $cartItem->qty
            ], $order, $product);


    
            if ($item['product_attribute_id']) {
                $productAttribute = ProductAttribute::where('id', $item['product_attribute_id'])
                    ->where('product_id', $product->id)
                    ->firstOrFail();
                    
                if ($productAttribute->qty < $cartItem->qty) {
                    throw new Exception("Insufficient quantity for product attribute: {$product->name} - {$productAttribute->name}");
                }
                
                $productAttribute->qty -= $cartItem->qty;
                $productAttribute->save();
            }
    
            // Update main product quantity
            if ($product->qty < $cartItem->qty) {
                throw new Exception("Insufficient quantity for product: {$product->name}");
            }
            
            $product->qty -= $cartItem->qty;
            $product->save();
    
            $cartItem->delete();
        }
    
        return $order;
    }
    
    private function createOrderItem($item, $order, $product)
    {
        return $order->orderedItems()->create([
            'product_id' => $item['product_id'],
            'product_attribute_id' => $item['product_attribute_id'],
            'order_id' => $order->id,
            'quantity' => $item['qty'],
            'price' => $product->selling_price * $item['qty'],
            'date_of_purchase' => now(),
            'custom_order_id' => $order->custom_order_id,
        ]);
    }
    private function generatePayload(float $amount)
    {
        $payload = [
            "merchantId" => config('services.phonePe.merchantId'),
            "merchantTransactionId" => uniqid('txn_'),
            "merchantUserId" => auth()->user()->id,
            "amount" => $amount * 100,
            "redirectUrl" => route('payment.redirect'),
            "callbackUrl" => route('payment.callback'),
            "mobileNumber" => auth()->user()->address()->first()->phone,
            "paymentInstrument" => [
                "type" => "PAY_PAGE"
            ]
        ];

        return base64_encode(json_encode($payload));
    }

    private function generateHeaders($payload): array
    {
        $endpoint = '/pg/v1/pay';
        $saltKey = config('services.phonePe.salt_key');
        $saltIndex = 1;

        $checksum = hash('sha256', $payload . $endpoint . $saltKey);
        $xVerify = $checksum . '###' . $saltIndex;

        return [
            'X-VERIFY' => $xVerify,
            'Content-Type' => 'application/json',
        ];
    }

    public function getCartItems()
    {
        $values = [
            'user_id' => auth()->user()->id,
            'guest_id' => Cookie::get('guest_id'),
        ];

        return $this->repository->getItems($values);
    }

    private function clearCart($cartItems)
    {
        foreach ($cartItems as $item) {

            $product = $item->product;

            if ($product->qty < $item->qty) {
                throw new Exception("Insufficient quantity for product: {$product->name}");
            }

            $this->repository->deleteItem($item->id);
        }
    }

    

    private function sendOrderNotification($order)
    {

        $user = User::query()
            ->with('roles')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })
            ->first();

        $user->notify(new OrderNotification('A New Order Has Been Placed.', $order));
    }
}
