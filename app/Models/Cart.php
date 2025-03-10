<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'qty', 'product_attribute_id', 'guest_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeCheckCartItems()
    {
        if (auth()->check()) {
            return $this->where('user_id', auth()->id());
        }

        return $this->where('guest_id', request()->cookie('guest_id'));
    }
}
