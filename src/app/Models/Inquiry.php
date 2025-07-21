<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'user_id', 'name', 'email', 'phone', 'country', 'city', 'message', 'status'
    ];
} 