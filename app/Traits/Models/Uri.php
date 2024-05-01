<?php

namespace App\Traits\Models;

trait Uri
{
    public function getRouteName()
    {
        return $this->route_name ?: 'route_name_not_set';
    }

    public function getClassName()
    {
        return strtolower(class_basename(static::class));
    }

    public function getRouteParameters()
    {
        return [$this->getClassName() => $this->id];
    }

    public function getIndexUriAttribute()
    {
        return route($this->getRouteName() . '.index');
    }

    public function getEditUriAttribute()
    {
        return route($this->getRouteName() . '.edit', $this->getRouteParameters());
    }

    public function getDeleteUriAttribute()
    {
        return route($this->getRouteName() . '.destroy', $this->getRouteParameters());
    }

    public function getUpdateUriAttribute()
    {
        return route($this->getRouteName() . '.update', $this->getRouteParameters());
    }

    public function getStoreUriAttribute()
    {
        return route($this->getRouteName() . '.store');
    }

    public function getShowUriAttribute()
    {
        return route($this->getRouteName() . '.show', $this->getRouteParameters());
    }

}
