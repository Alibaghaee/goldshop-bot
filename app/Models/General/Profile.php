<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'profiles';

    protected $table = 'admins';

    protected $guarded = [];

    // {{dont_delete_this_comment}}
}
