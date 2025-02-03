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

        if (!$coupon || $coupon->expires_at && $coupon->expires_at->isPast()) {
            return null;
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
