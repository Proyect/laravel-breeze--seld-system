<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'sale_id',
        'method',
        'status',
        'payment_status',
        'amount',
        'currency',
        'provider',
        'provider_payment_id',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'amount' => 'decimal:2',
    ];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sales::class, 'sale_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function markAsApproved(): void
    {
        $this->payment_status = 'approved';
        $this->save();

        if ($this->sale_id && $this->sale && $this->sale->status === 'pending') {
            $this->sale->update(['status' => 'processing']);
        }
    }

    public function markAsRejected(): void
    {
        $this->payment_status = 'rejected';
        $this->save();
    }
}
