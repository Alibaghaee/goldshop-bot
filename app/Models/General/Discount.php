<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Helpers\DiscountCode;
use App\Models\General\DiscountItem;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Morilog\Jalali\Jalalian;

class Discount extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'discounts';

    protected $guarded = [];

    protected $appends = ['index_uri', 'item_create_uri'];

    protected $dates = ['expires_at', 'starts_at'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($discount) {
            $discount->items->each->delete();
        });
    }

    public function getStartsAtFaAttribute()
    {
        return $this->starts_at ? Jalalian::fromDateTime($this->starts_at)->format('Y/m/d H:i') : '';
    }

    public function getExpiresAtFaAttribute()
    {
        return $this->expires_at ? Jalalian::fromDateTime($this->expires_at)->format('Y/m/d H:i') : '';
    }

    public function items()
    {
        return $this->hasMany('App\Models\General\DiscountItem');
    }

    public function getItemsUriAttribute()
    {
        return route('discounts.discount_items.index', ['discount' => $this->id]);
    }

    public function getItemCreateUriAttribute()
    {
        return route('discounts.discount_items.create', ['discount' => $this->id]);
    }

    public function InsertDiscountItems($data)
    {
        $discount_code = new DiscountCode;
        $codes         = $discount_code->create(
            $this->id, Arr::get($data, 'count'), Arr::get($data, 'discount_amount'), Arr::get($data, 'starts_at'), Arr::get($data, 'expires_at'), Arr::get($data, 'is_percent', false), Arr::get($data, 'max_uses')
        );

        DiscountItem::insert($codes->toArray());
    }

    public function updateDiscountItems($data)
    {
        $this->items()->update($data);
    }

}
