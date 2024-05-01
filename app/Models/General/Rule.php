<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'rules';

    protected $guarded = [];

    public static function scopeAsOption($query)
    {
        return $query->select('rules.id', 'title as name')->get();
    }

    // {{dont_delete_this_comment}}
}
