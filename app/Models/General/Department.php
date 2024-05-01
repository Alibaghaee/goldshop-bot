<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\ModelsScope\Traits\DomainScopeTrait;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use Uri, View, Filterable, DomainScopeTrait;

    protected $route_name = 'departments';

    protected $guarded = [];

    public static function scopeAsOption($query)
    {
        return $query->select('title as name', 'id')->get();
    }

    // {{dont_delete_this_comment}}
}
