<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function admins()
    {
        return $this->hasMany('App\Models\General\Admin');
    }

    public function levels()
    {
        return $this->hasMany('App\Models\General\Level');
    }
}
