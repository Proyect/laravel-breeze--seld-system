<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    // SUGERENCIA: El nombre estándar en Laravel es 'Sale' (singular), considera renombrar el modelo y la tabla.
    // SUGERENCIA: Si tienes detalles de venta:
    // public function details() {
    //     return $this->hasMany(SalesDetail::class);
    // }
    protected $fillable = ['user_id', 'status', 'total_amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}

