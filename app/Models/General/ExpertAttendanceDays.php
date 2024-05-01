<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\ModelsScope\Traits\DomainScopeTrait;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class ExpertAttendanceDays extends Model
{
    use Uri, View, Filterable, DomainScopeTrait;

    protected $route_name = 'expert_attendance_days';

    protected $guarded = [];

    // {{dont_delete_this_comment}}
}
