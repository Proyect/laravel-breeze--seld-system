<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // SUGERENCIA: Si un pago pertenece a un usuario además de una venta:
    // public function user() {
    //     return $this->belongsTo(User::class);
    // }
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

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
