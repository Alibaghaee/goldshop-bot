<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Payment extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'payments';

    protected $guarded = [];

    protected $appends = ['fullname', 'created_at_fa', 'payed_title'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getFullnameAttribute()
    {
        return optional($this->user)->fullname;
    }

    public function getCreatedAtFaAttribute()
    {
        return Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i');
    }

    public function scopePayed($query)
    {
        return $query->where('payed', true);
    }

    public function getPayedTitleAttribute()
    {
        return $this->payed == true ? 'موفق' : 'ناموفق';
    }

    // {{dont_delete_this_comment}}
}
