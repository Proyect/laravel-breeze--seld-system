<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'stock', 'status', 'images'];

    protected $casts = [
        'images' => 'array',
        'price' => 'decimal:2',
    ];

    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(Sales::class, 'product_sales', 'product_id', 'sales_id')
            ->withPivot('quantity', 'unit_price')
            ->withTimestamps();
    }
}
