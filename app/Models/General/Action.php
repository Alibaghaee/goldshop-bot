<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    public $appends = ['url'];

    public function controller()
    {
        return $this->belongsTo('App\Models\General\Controller');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\General\Role');
    }

    public function levels()
    {
        return $this->belongsToMany('App\Models\General\Level')->withTimestamps();
    }

    public function getUrlAttribute()
    {
        if ($this->name == 'index' || $this->name == 'store') {
            return
            '/' . $this->controller->module->name .
            '/' . $this->controller->name;
        }
        if ($this->name == 'create') {
            return
            '/' . $this->controller->module->name .
            '/' . $this->controller->name .
            '/' . $this->name;
        }
        if ($this->name == 'show' || $this->name == 'update' || $this->name == 'destroy') {
            return
            '/' . $this->controller->module->name .
            '/' . $this->controller->name .
            '/' . $this->attributes[$this->getRouteKeyName()];
        }
        if ($this->name == 'edit') {
            return
            '/' . $this->controller->module->name .
            '/' . $this->controller->name .
            '/' . $this->attributes[$this->getRouteKeyName()] .
                '/edit';
        }
        if ($this->name == 'insert') {
            return
            '/' . $this->controller->module->name .
            '/' . $this->controller->name .
            '/' . $this->name;
        }

        if ($this->name == 'driversCreate') {
            return
            '/' . $this->controller->module->name .
            '/' . $this->controller->name .
            '/' . $this->name;
        }

    }
}
