<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\ModelsScope\Traits\DomainScopeTrait;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use Uri, View, Filterable, DomainScopeTrait;

    protected $route_name = 'rooms';

    protected $guarded = [];

    // {{dont_delete_this_comment}}

    public static function scopeAsOption($query)
    {
        return $query->selectRaw('title as name, id')->get();
    }
}
