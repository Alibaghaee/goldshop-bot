<?php

namespace App\Traits\Models;

use App\Traits\Models\Uri;

trait UriForItems
{
    use Uri;

    public function getRouteParameters()
    {
        $first_param  = request_parameter(0);
        $second_param = request_parameter(1);
        return [
            $first_param  => $this->$first_param->id,
            $second_param => $this->id,
        ];
    }

    public function getStoreUriAttribute()
    {
        return route($this->getRouteName() . '.store', [
            request_parameter(0) => request()->route()->parameters()[request_parameter(0)]->id,
        ]);
    }
}
