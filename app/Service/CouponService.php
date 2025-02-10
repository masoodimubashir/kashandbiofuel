<?php

namespace App\Service;

use App\Models\Coupon;

class CouponService
{
    public function __construct()
    {
    }

    public function validateCoupon(string $coupon_code): ?Coupon
    {

        $coupon = Coupon::where('coupon_code', $coupon_code)
            ->where('status', 1)
            ->first();

        if (!$coupon || $coupon->end_date && $coupon->end_date < now()) {
            // dd('Coupon is expired');
            throw new \Exception('Coupon is expired');
        }


        return $coupon;
    }

    public function calculateDiscount(float $checkoutTotal, Coupon $coupon): float
    {

        if ($coupon->coupon_type == 1) {
            return $checkoutTotal * ($coupon->discount_value / 100);
        } elseif ($coupon->coupon_type == 2) {
            return $checkoutTotal - $coupon->discount_value;
        }

        return 0;
    }

}
