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
        'order_message',
        'is_shipped',
        'tracking_id',
    ];


    protected function casts(): array
    {
        return [
            'date_of_purchase' => 'datetime:d-M-Y',
            'is_cancelled' => 'boolean',
            'is_delivered' => 'boolean',
            'is_confirmed' => 'boolean',
            'is_shipped' => 'boolean',
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
        switch (true) {
            case $this->is_cancelled:
                return 'CANCELLED';
                
            case $this->is_delivered && $this->is_confirmed && $this->is_shipped:
                return 'DELIVERED';
                
            case $this->is_shipped && $this->is_confirmed:
                return 'SHIPPED';
                
            case $this->is_confirmed:
                return 'CONFIRMED';
                
            default:
                return 'PENDING';
        }
    }
    

    public function getYestardayDateAttribute()
    {
        return $this->date_of_purchase->subDay()->format('d-M-Y');
    }
}
