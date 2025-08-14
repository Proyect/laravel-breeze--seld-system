<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // SUGERENCIA: Si un producto pertenece a una categoría, puedes agregar:
    // public function category() {
    //     return $this->belongsTo(Category::class);
    // }
    //
    // SUGERENCIA: Si un producto tiene muchos detalles de venta:
    // public function salesDetails() {
    //     return $this->hasMany(SalesDetail::class);
    // }
    //
    // SUGERENCIA: Si un producto puede estar en muchas ventas (relación muchos a muchos):
    // public function sales() {
    //     return $this->belongsToMany(Sales::class)->withPivot('quantity');
    // }
    protected $fillable = ['name', 'description', 'price', 'stock', 'status', 'images'];
   
    protected $casts = [
        'images' => 'array',
    ];
}
