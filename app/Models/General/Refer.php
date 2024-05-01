<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Morilog\Jalali\Jalalian;

class Refer extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'refers';

    protected $guarded = [];

    public function task()
    {
        return $this->belongsTo('App\Models\General\Task');
    }

    public function from()
    {
        return $this->belongsTo('App\Models\General\Admin', 'from_admin_id');
    }

    public function to()
    {
        return $this->belongsTo('App\Models\General\Admin', 'to_admin_id');
    }

    public function getCreatedAtFaAttribute()
    {
        return Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i');
    }

    public function createRefer($data)
    {
        // create refer
        $data['task_id'] = $this->task->id;
        $data            = multiselect_adapter($data);
        auth()->user()->refers()->create($data);
        $this->update(['referred' => true]);

        // update task
        if ($this->isReport($data)) {
            $this->task->update([
                'reported_at'        => now(),
                'report_description' => Arr::get($data, 'description'),
            ]);
        }
    }

    public function isReport($data)
    {
        return (Arr::get($data, 'to_admin_id') == $this->task->creator_admin_id) &&
            (auth()->id() == $this->task->assigned_to_admin_id);
    }

    /**
     * Scope a query to only include owned refers.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOwned($query)
    {
        return $query->where('to_admin_id', auth()->id());
    }

    // {{dont_delete_this_comment}}
}
