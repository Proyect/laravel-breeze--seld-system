<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
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

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'metadata' => 'array',
        ];
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sales::class, 'sale_id');
    }
}
