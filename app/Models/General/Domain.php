<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    public function admin()
    {
        return $this->belongsTo('App\Models\General\Admin');
    }
}
