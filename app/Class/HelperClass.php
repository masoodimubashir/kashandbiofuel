<?php

namespace App\Class;

use App\Service\CouponService;

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
    public function calculateItemTotalsAndGrandTotal(array $values, $repository): array
    {

        $items = $repository->getItems($values);

        $couponCode = $values['coupon_code'] ?? null;

        $checkOutPrice = 0;
        $discount = 0;

        $items = $items->map(function ($item) use (&$checkOutPrice) {
            $this->processItemCalculations($item);
            $checkOutPrice += $item->product->grand_total;

            return $item;
        });

        if ($couponCode) {

            $couponService = app()->make(CouponService::class);

            $coupon = $couponService->validateCoupon($couponCode);

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
        $originalPrice = round($item->product->price);
        $sellingPrice = round($item->product->selling_price);

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


}
