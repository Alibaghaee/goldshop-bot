<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public static function scopeAsOption($query)
    {
        return $query->select('name', 'id')->get();
    }
}
