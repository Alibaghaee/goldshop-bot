<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'prizes';

    protected $guarded = [];

    // {{dont_delete_this_comment}}
}
