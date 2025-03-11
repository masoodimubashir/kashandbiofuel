<?php

namespace App\Service;

use App\Events\OrderPlacedEvent;
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
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PhonepeService
{
    private CartRepository $repository;

    public function __construct(CartRepository $repository)
    {
        $this->repository = $repository;
    }

    public function processSuccessfulPayment($orderData)
    {
        try {

            DB::beginTransaction();

            $transaction = $this->createTransaction($orderData);

            $order = $this->createOrder($orderData, $transaction);

            $order->load([
                'orderedItems.product.productAttributes',
                'address.user',
                'transaction'
            ]);

            event(new OrderPlacedEvent($order));

            $this->sendOrderNotification($order);

            DB::commit();

            return [
                'status' => true,
                'order' => $order,
                'transaction' => $transaction,
            ];
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Payment Processing Error: ' . $e->getMessage());
            throw new HttpException(500, 'Failed to process payment: ' . $e->getMessage());
        }
    }

    private function createTransaction($orderData)
    {
        return Transaction::create([
            'user_id' => auth()->user()->id,
            'amount' => $orderData['amount'],
            'status' => true,
            'payment_method' => 'phonepe',
            'transaction_id' => $orderData['paymentDetails'][0]['transactionId'],
            'payment_details' => json_encode($orderData['paymentDetails'])
        ]);
    }

    private function createOrder($orderData, $transaction)
    {


        $cartData = json_decode($orderData['metaInfo']['udf2'], true);
        $address_id = $orderData['metaInfo']['udf3'];

        $order = Order::create([
            'user_id' => $transaction->user_id,
            'custom_order_id' => uniqid('cus_'),
            'address_id' => $address_id,
            'total_amount' => $transaction->amount,
            'date_of_purchase' => now(),
            'transaction_id' => $transaction->id,
            'is_confirmed' => true,
            'payment_method' => 'phonepe',
            'order_message' => 'placed'
        ]);



        foreach ($cartData as $item) {
            $this->processOrderItem($item, $order);
        }

        return $order;
    }

    private function processOrderItem($item, $order)
    {
        $cartItem = Cart::findOrFail($item['cart_id']);
        $product = Product::findOrFail($cartItem->product_id);

        // Remove from wishlist if exists
        Wishlist::where('product_id', $product->id)
            ->where('user_id', auth()->user()->user_id)
            ->delete();

        // Create order item
        $this->createOrderItem([
            'product_id' => $product->id,
            'product_attribute_id' => $item['product_attribute_id'],
            'qty' => $cartItem->qty
        ], $order, $product);

        // Update product attribute stock
        if ($item['product_attribute_id']) {
            $this->updateProductAttributeStock($item, $cartItem, $product);
        }

        // Update product stock
        $this->updateProductStock($cartItem, $product);

        // Remove cart item
        $cartItem->delete();
    }

    private function updateProductAttributeStock($item, $cartItem, $product)
    {
        $productAttribute = ProductAttribute::where('id', $item['product_attribute_id'])
            ->where('product_id', $product->id)
            ->firstOrFail();

        $productAttribute->decrement('qty', $cartItem->qty);
    }

    private function updateProductStock($cartItem, $product)
    {

        $product->decrement('qty', $cartItem->qty);
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

    private function sendOrderNotification($order)
    {
        $admin = User::whereHas('roles', fn($q) => $q->where('name', 'admin'))->first();
        $admin->notify(new OrderNotification('A New Order Has Been Placed.', $order));
    }
}
