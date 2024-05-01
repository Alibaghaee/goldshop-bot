<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Controller extends Model
{
    public function module()
    {
        return $this->belongsTo('App\Models\General\Module');
    }

    public function actions()
    {
        return $this->hasMany('App\Models\General\Action');
    }

    public function createActions($actions)
    {
        foreach ($actions as $action) {
            $this->actions()
                ->create($action)
                ->levels()
                ->sync(config('portal.levels_with_all_permissions'));
        }
    }
}
