<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Attendance extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'attendances';

    protected $guarded = [];

    protected $dates = ['entry_date', 'exit_date'];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('scope', function (Builder $builder) {
            if (auth()->user()->role_id >= 3) {
                $builder->where('admin_id', auth()->id());
            }
        });
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\General\Admin');
    }

    public function getCreatedAtFa()
    {
        return Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i');
    }

    public function getEntryDateFaAttribute()
    {
        return Jalalian::fromCarbon($this->entry_date)->format('Y/m/d');
    }

    public function getEntryDayFaAttribute()
    {
        return Jalalian::fromCarbon($this->entry_date)->format('l');
    }

    public function getExitDateFaAttribute()
    {
        return $this->exit_date ? Jalalian::fromCarbon($this->exit_date)->format('Y/m/d') : '';
    }

    public function getEntryTimeAttribute()
    {
        return Jalalian::fromCarbon($this->entry_date)->format('H:i');
    }

    public function getExitTimeAttribute()
    {
        return $this->exit_date ? Jalalian::fromCarbon($this->exit_date)->format('H:i') : '';
    }

    // {{dont_delete_this_comment}}
}
