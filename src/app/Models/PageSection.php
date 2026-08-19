<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = ['key', 'title', 'content', 'descripcion'];

    public static function getByKey(string $key): ?self
    {
        return self::where('key', $key)->first();
    }
}
