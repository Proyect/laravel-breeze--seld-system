<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['sale_id', 'method', 'status', 'amount'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
