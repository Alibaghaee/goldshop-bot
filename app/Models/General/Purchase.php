<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Purchase extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'purchases';

    protected $guarded = [];

    protected $appends = ['fullname', 'created_at_fa', 'payed_title', 'type_title', 'package_title'];

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

    public function details()
    {
        return $this->hasMany('App\Models\General\PurchaseDetail');
    }

    public function getPaymentLinkAttribute()
    {
        return '/' . app()->getLocale() . '/bank/request?id=' . $this->id;
    }

    public function discountItem()
    {
        return $this->belongsTo('App\Models\General\DiscountItem');
    }

    public function package()
    {
        return $this->belongsTo('App\Models\General\Package');
    }

    public function getTypeTitleAttribute()
    {
        return collect(config('portal.purchase_types'))->where('id', $this->type)->first()['name'];
    }

    public function getPackageTitleAttribute()
    {
        return optional($this->package)->title;
    }

    // {{dont_delete_this_comment}}
}
