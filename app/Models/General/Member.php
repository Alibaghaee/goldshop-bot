<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Jenssegers\Mongodb\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Member extends Model
{
    use Uri, View, Filterable;

    protected $connection = 'mongodb';

    protected $collection = 'members';

    protected $route_name = 'members';

    protected $guarded = [];

    protected $appends = ['city_title', 'province_title'];

    public function getFullnameAttribute()
    {
        return $this->name . ' ' . $this->family;
    }

    public function province()
    {
        return $this->belongsTo('App\Models\General\Province');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\General\City');
    }

    public function getCreatedAtFaAttribute()
    {
        return $this->created_at ? Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i:s') : '';
    }

    public function getUpdatedAtFaAttribute()
    {
        return $this->updated_at ? Jalalian::fromDateTime($this->updated_at)->format('Y/m/d H:i:s') : '';
    }

    public function getBirthDateFaAttribute()
    {
        return $this->birth_date ? Jalalian::fromDateTime($this->birth_date)->format('Y/m/d') : '';
    }

    public static function scopeAsOption($query)
    {
        return $query->select('id', \DB::raw("CONCAT(name, ' ', family, ' - کد ملی: ', national_code) as name"))->get();
    }

    public function getCityTitleAttribute()
    {
        return optional($this->city)->name;
    }

    public function getProvinceTitleAttribute()
    {
        return optional($this->province)->name;
    }

    // {{dont_delete_this_comment}}
}
