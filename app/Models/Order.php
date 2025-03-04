<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'custom_order_id',
        'address_id',
        'total_amount',
        'date_of_purchase',
        'is_cancelled',
        'is_delivered',
        'is_confirmed',
        'transaction_id',
        'payment_method'
    ];


    protected function casts(): array
    {
        return [
            'date_of_purchase' => 'datetime:d-M-Y',
            'is_cancelled' => 'boolean',
            'is_delivered' => 'boolean',
            'is_confirmed' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with the user

    public function orderedItems(): HasMany
    {
        return $this->hasMany(OrderedItem::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function getStatusAttribute()
    {
        if ($this->is_cancelled) {
            return 'Cancelled';
        }

        if ($this->is_delivered) {
            return 'Delivered';
        }

        if ($this->is_confirmed) {
            return 'Confirmed';
        }

        return 'Pending';
    }

    public function getYestardayDateAttribute()
    {
        return $this->date_of_purchase->subDay()->format('d-M-Y');
    }
}
