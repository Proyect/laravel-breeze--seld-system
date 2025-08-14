<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    // SUGERENCIA: El nombre estándar sería 'SaleDetail' y la relación sería belongsTo Sale y Product.
    // public function sale() {
    //     return $this->belongsTo(Sale::class);
    // }
    // public function product() {
    //     return $this->belongsTo(Product::class);
    // }

    public function sales()
    {
        return $this->belongsToMany(Sale::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
