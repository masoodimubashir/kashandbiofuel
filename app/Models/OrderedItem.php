<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderedItem extends Model
{
    protected $fillable = [
        'product_id',
        'order_id',
        'quantity',
        'price',
        'date_of_purchase',
        'custom_order_id',
        'product_attribute_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    protected function casts(): array
    {
        return [
            'date_of_purchase' => 'datetime',
        ];
    }

}
