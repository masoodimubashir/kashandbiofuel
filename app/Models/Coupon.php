<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{

    protected $fillable = [
        'coupon_code',
        'coupon_type',
        'discount_value',
        'end_date',
        'status'

    ];
}
