<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Locale;
use App\Traits\Models\Removable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Setting extends Model
{
    use Uri, View, Filterable, Removable, Locale;

    protected $route_name = 'settings';

    protected $guarded = [];

    protected $appends = ['type_title'];

    public function getTypeTitleAttribute()
    {
        return Arr::get(collect(config('portal.setting_types'))->firstWhere('id', $this->type), 'name');
    }
}
