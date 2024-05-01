<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Customer extends Model
{
    use Uri, View, Filterable, SoftDeletes;

    protected $route_name = 'customers';

    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo('App\Models\General\Admin');
    }

    public function group()
    {
        return $this->belongsTo('App\Models\General\CategoryItem', 'group_id');
    }

    public function know()
    {
        return $this->belongsTo('App\Models\General\CategoryItem', 'how_know_id');
    }

    public function getCreatedAtFaAttribute()
    {
        return $this->created_at ? Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i') : '';
    }

    public function getBirthDateFaAttribute()
    {
        return $this->birth_date ? Jalalian::fromDateTime($this->birth_date)->format('Y/m/d') : '';
    }

    public function getFullnameAttribute()
    {
        if ($this->type == 1) {
            return $this->name . ' ' . $this->family;
        }
        return $this->company_name;
    }

    public function getTypeTitleAttribute()
    {
        $types = collect(config('portal.customer_types'));
        $type  = $types->where('id', $this->type)->first();
        return array_get($type, 'name');
    }

    public function getSexTitleAttribute()
    {
        $sex = collect(config('portal.sex'));
        $sex = $sex->where('id', $this->sex)->first();
        return array_get($sex, 'name');
    }

    public function scopeAsOption($query)
    {
        return $query->select('id', \DB::raw("CONCAT(IFNULL(`name`,''), ' ', IFNULL(`family`,''), ' ', IFNULL(`company_name`,''), ' ', IFNULL(`mobile`,'')) as name"))->get();
    }

    // {{dont_delete_this_comment}}
}
