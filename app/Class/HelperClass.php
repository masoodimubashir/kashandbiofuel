<?php

namespace App\Class;

use App\Service\CouponService;
use Log;

trait HelperClass
{


    /**
     * Calculate totals for items and compute a grand total.
     *
     * This method retrieves items based on the provided values, processes each item to calculate
     * the grand total, and adds up their total prices.
     *
     * @param array $values Associative array containing user or guest identification keys.
     * @param mixed $repository The repository being used (Cart or Wishlist).
     * @return array An array with two elements:
     *               - A collection of processed items with individual calculations included.
     *               - The grand total price of all items.
     */
    // public function calculateItemTotalsAndGrandTotal(array $values, $repository): array
    // {

    //     $items = $repository->getItems($values);

    //     dd($items);

    //     $couponCode = $values['coupon_code'] ?? null;

    //     $checkOutPrice = 0;
    //     $discount = 0;

    //     $items = $items->map(function ($item) use (&$checkOutPrice) {
    //         $this->processItemCalculations($item);
    //         $checkOutPrice += $item->product->grand_total;
    //         return $item;
    //     });

    //     if ($couponCode) {

    //         $couponService = app()->make(CouponService::class);

    //         $coupon = $couponService->validateCoupon($couponCode);

    //         if ($coupon) {
    //             $discount = $checkOutPrice;
    //             $checkOutPrice = $couponService->calculateDiscount($checkOutPrice, $coupon);
    //             $discount -= $checkOutPrice;
    //         }
    //     }

    //     return [$items, $checkOutPrice, $discount];
    // }

    public function calculateItemTotalsAndGrandTotal(array $values, $repository): array
    {
        $items = $repository->getItems($values);
        $checkOutPrice = 0;
        $discount = 0;

        $items = $items->map(function ($item) use (&$checkOutPrice) {
            $this->processItemCalculations($item);
            $checkOutPrice += $item->product->grand_total;
            return [
                'id' => $item->id,
                'guest_id' => $item->guest_id,
                'user_id' => $item->user_id,
                'product_id' => $item->product_id,
                'qty' => $item->qty,
                'product_attribute_id' => $item->product_attribute_id,
                'product' => [
                    'name' => $item->product->name,
                    'slug' => $item->product->slug,
                    'price' => $item->product->price,
                    'selling_price' => $item->product->selling_price,
                    'grand_total' => $item->product->grand_total,
                    'saving_amount' => $item->product->saving_amount,
                    'saving_percentage' => $item->product->saving_percentage,
                    'product_attribute' => $item->product->productAttributes
                        ->where('id', $item->product_attribute_id)
                        ->map(function ($attribute) {
                            return [
                                'id' => $attribute->id,
                                'hex_code' => $attribute->hex_code,
                                'image_path' => $attribute->image,
                                'qty' => $attribute->qty
                            ];
                        })
                        ->first()
                ]
            ];
        });

        if (isset($values['coupon_code'])) {
            $couponService = app()->make(CouponService::class);
            $coupon = $couponService->validateCoupon($values['coupon_code']);

            if ($coupon) {
                $discount = $checkOutPrice;
                $checkOutPrice = $couponService->calculateDiscount($checkOutPrice, $coupon);
                $discount -= $checkOutPrice;
            }
        }

        return [$items, $checkOutPrice, $discount];
    }



    /**
     * Process item calculations such as grand total, saving amount, and saving percentage.
     *
     * @param object $item
     * @return void
     */
    private function processItemCalculations(object $item): void
    {
        $qty = $item->qty;

        $originalPrice = $item->product->price;
        $sellingPrice =  $item->product->selling_price;

        // Calculate the item's grand total
        $item->product->grand_total = $this->calculateItemTotal($qty, $sellingPrice);

        // Calculate the item's saving amount
        $item->product->saving_amount = $this->calculateSavingAmount($originalPrice, $sellingPrice);

        // Calculate the item's saving percentage
        $item->product->saving_percentage = $this->calculateSavingPercentage(
            $item->product->saving_amount,
            $sellingPrice
        );
    }

    /**
     * Calculate the total price for a specific item.
     *
     * @param int $qty
     * @param int $sellingPrice
     * @return int
     */
    private function calculateItemTotal(int $qty, int $sellingPrice): int
    {
        return $qty * $sellingPrice;
    }

    /**
     * Calculate the saving amount for an item.
     *
     * @param int|null $price
     * @param int|null $sellingPrice
     * @return int
     */
    private function calculateSavingAmount(?int $price, ?int $sellingPrice): int
    {
        return $price === null ? 0 : $price - $sellingPrice;
    }

    /**
     * Calculate the saving percentage for an item.
     *
     * @param int $savingAmount
     * @param int $sellingPrice
     * @return int
     */
    private function calculateSavingPercentage(int $savingAmount, int $sellingPrice): int
    {
        return $sellingPrice > 0 ? ($savingAmount / $sellingPrice) * 100 : 0;
    }


    public function processObjectToArray(object $item): array
    {

        return [
            'id' => $item->id,
            'guest_id' => $item->guest_id,
            'user_id' => $item->user_id,
            'product_id' => $item->product_id,
            'qty' => $item->qty,
            'product_attribute_id' => $item->product_attribute_id,
        ];
    }


    // Tranforming order to array
    public function transformOrder($order)
    {

        // If the order doesn't exist, return null
        if (!$order) {
            return null;
        }

        // Transform the order data
        return [
            'id' => $order->id,
            'is_confirmed' => $order->is_confirmed,
            'is_delivered' => $order->is_delivered,
            'is_cancelled' => $order->is_cancelled,
            'status' => $order->status,
            'custom_order_id' => $order->custom_order_id,
            'date_of_purchase' => $order->created_at->format('Y-m-d H:i:s'),
            'customer_id' => $order->address->user->id ?? null,
            'transaction_id' => $order->transaction->transaction_id ?? null,
            'total_amount' => $order->total_amount,
            'name' => $order->address->user->name ?? null,
            'email' => $order->address->user->email ?? null,
            'image' => $order->address->user->image_path ?? null,
            'phone' => $order->address->phone ?? null,
            'full_address' => $order->address->address . '-' . $order->address->city . '-' . $order->address->state . '-' . $order->address->country,
            'contact_number' => $order->address->user->contact_number ?? null,
            'pincode' => $order->address->pin_code ?? null,
            'payment_method' => $order->payment_method ?? null,

            'orderedItems' => collect($order->orderedItems)->map(function ($item) {
                // Get all product attributes for the product
                $attributes = collect($item->product->productAttributes)
                    ->map(function ($attribute) use ($item) {
                        return [
                            'image_path' => $attribute->image_path,
                            'qty' => $item->quantity,
                            'hex_code' => $attribute->hex_code,
                        ];
                    })->toArray();

                return [
                    'id' => $item->product->id,  // Important for grouping
                    'product_name' => $item->product->name,
                    'selling_price' => $item->product->selling_price,
                    'attributes' => $attributes,
                ];
            })->toArray(),

            'shipping_address' => [
                'address' => $order->address->address ?? null,
                'city' => $order->address->city ?? null,
                'state' => $order->address->state ?? null,
            ]
        ];
    }
}
