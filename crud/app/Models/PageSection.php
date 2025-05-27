<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = ['key', 'title', 'content','description'];

    public static function getByKey($key)
    {
        return self::where('key', $key)->first();
    }
}
