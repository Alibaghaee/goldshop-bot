<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public static function scopeAsOption($query)
    {
        return $query->select('name', 'id')->get();
    }

    public function cities()
    {
        return $this->hasMany('App\Models\General\City');
    }
}
