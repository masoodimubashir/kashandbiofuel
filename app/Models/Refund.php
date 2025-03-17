<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Refund extends Model
{
    protected $fillable = [
        'order_id',
        'transaction_id',
        'refund_id',
        'amount',
        'status',
        'phonepe_refund_id',
        'refund_initiated_at',
        'refund_completed_at',
    ];

    public function order(): BelongsTo{
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function transaction(): BelongsTo{
        return $this->belongsTo(Transaction::class);
    }
}
