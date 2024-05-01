<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Morilog\Jalali\Jalalian;

class SendedLetter extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'sended_letters';

    protected $guarded = [];

    protected $dates = ['date'];

    public function admin()
    {
        return $this->belongsTo('App\Models\General\Admin');
    }

    public function getDateFaAttribute()
    {
        return Jalalian::fromCarbon($this->date)->format('Y/m/d');
    }

    public function getExportUrlAttribute()
    {
        return '/letters/sended_letters/export/' . $this->id;
    }

    public function getSizeNameAttribute()
    {
        return Arr::get(collect(config('portal.letter_sizes'))->where('id', $this->size)->first(), 'name');
    }

    // {{dont_delete_this_comment}}
}
