<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class AvanakCallDetail extends Model
{
    public function scopeUnsended($query)
    {
        return $query->where('sended', 0);
    }

    public function scopeUpdateToSended($query)
    {
        return $query->update(['sended' => 1]);
    }
}
