<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\ModelsScope\Traits\DomainScopeTrait;
use App\Models\General\Category;
use App\Models\General\Form;
use App\Models\General\Purchase;
use App\Traits\Models\Uri;
use App\Models\User;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use Uri, View, Filterable, DomainScopeTrait;

    protected $route_name = 'packages';

    protected $guarded = [];

    protected $appends = ['confirm_url', 'store_url', 'index_url', 'purchase_url', 'show_url', 'products_url', 'fill_out_profile_store_url', 'fill_out_profile_confirm_url', 'user_supplementary_price', 'fill_out_profile_url'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($package) {
            $package->products->each->delete();
        });
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\General\Product')->withTimestamps();
    }

    public function getConfirmUrlAttribute()
    {
        return '/fa/registration/confirm/' . $this->id;
    }

    public function getStoreUrlAttribute()
    {
        return '/fa/registration/' . $this->id;
    }

    public function getIndexUrlAttribute()
    {
        return '/fa/registration/' . $this->id;
    }

    public function getPurchaseUrlAttribute()
    {
        return '/fa/pay_page/' . $this->id;
    }

    public function getShowUrlAttribute()
    {
        return '/fa/packages/' . $this->id;
    }

    public function getProductsUrlAttribute()
    {
        return '/fa/package/' . $this->id . '/products/categories';
    }

    public function getFillOutProfileUrlAttribute()
    {
        return route('fill_out_profile.edit', [app()->getLocale(), $this->id]);
    }

    public function getFillOutProfileConfirmUrlAttribute()
    {
        return route('fill_out_profile.confirm', [app()->getLocale(), $this->id]);
    }

    public function getFillOutProfileStoreUrlAttribute()
    {
        return route('fill_out_profile.update', [app()->getLocale(), $this->id]);
    }

    public function user()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function getIsBuyedAttribute()
    {
        return auth()->check() ? auth()->user()->hasPackage($this->id) : false;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function scopeAsOption($query)
    {
        return $query->select('title as name', 'id')->get();
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function getUserSupplementaryPriceAttribute()
    {
        return auth()->guard('web')->check() ? auth()->guard('web')->user()->payablePrice($this->id) : 0;
    }

    public function prices()
    {
        return [
            1 => $this->pre_payment,
            2 => $this->price,
            3 => $this->user_supplementary_price,
        ];
    }

    // {{dont_delete_this_comment}}
}
