<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Task extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'tasks';

    protected $guarded = [];

    protected $dates = ['start_date', 'deadline', 'reported_at'];

    public function creator()
    {
        return $this->belongsTo('App\Models\General\Admin', 'creator_admin_id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Models\General\Admin', 'assigned_to_admin_id');
    }

    public function refers()
    {
        return $this->hasMany('App\Models\General\Refer');
    }

    public function getStartDateFaAttribute()
    {
        return $this->start_date ? Jalalian::fromDateTime($this->start_date)->format('Y/m/d H:i') : '';
    }

    public function getDeadlineFaAttribute()
    {
        return $this->deadline ? Jalalian::fromDateTime($this->deadline)->format('Y/m/d H:i') : '';
    }

    public function getReportedAtFaAttribute()
    {
        return $this->reported_at ? Jalalian::fromDateTime($this->reported_at)->format('Y/m/d H:i') : '';
    }

    public function getReportStatusAttribute()
    {
        if ($this->isDeadlineOvered() && !$this->reported_at) {
            return 'عدم ارسال';
        }
        if (!$this->reported_at) {
            return '';
        }
        if ($this->reported_at->gt($this->deadline)) {
            return 'با تاخیر';
        }
        if ($this->reported_at->lte($this->deadline)) {
            return 'به موقع';
        }
    }

    public function isDeadlineOvered()
    {
        if (now()->gt($this->deadline)) {
            return true;
        }
        return false;
    }

    public function getStatusTitleAttribute()
    {
        $task_status = collect(config('portal.task_status'));
        $status      = $task_status->where('id', $this->status)->first();
        return array_get($status, 'name');
    }

    // {{dont_delete_this_comment}}
}
