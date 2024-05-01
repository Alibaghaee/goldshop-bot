<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\ModelsScope\Traits\DomainScopeTrait;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use Uri, View, Filterable, DomainScopeTrait;

    protected $route_name = 'experts';

    protected $guarded = [];

    protected $appends = ['department_name'];

    // {{dont_delete_this_comment}}

    public function department()
    {
        return $this->belongsTo('App\Models\General\Department');
    }

    public function getDepartmentNameAttribute()
    {
        return $this->department->title ?? '';
    }

    public static function scopeAsOption($query)
    {
        return $query->selectRaw('Concat(name, " ",family) as name, id')->get();
    }

}
