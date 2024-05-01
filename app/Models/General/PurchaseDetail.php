<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $guarded = [];
    
    public function purchase()
    {
        return $this->belongsTo('App\Models\General\Purchase');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\General\Product');
    }

    // {{dont_delete_this_comment}}
}
