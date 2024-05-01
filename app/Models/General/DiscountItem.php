<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\UriForItems;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

class DiscountItem extends Model
{
    use UriForItems, View, Filterable;

    protected $route_name = 'discounts.discount_items';

    protected $guarded = [];

    protected $dates = ['expires_at', 'starts_at'];

    public function discount()
    {
        return $this->belongsTo('App\Models\General\Discount');
    }

    public function IsExpired()
    {
        return $this->expires_at ? Carbon::now()->gte($this->expires_at) : false;
    }

    public function IsStarted()
    {
        return $this->starts_at ? Carbon::now()->gt($this->starts_at) : false;
    }

    /**
     * Check if code amount is over.
     *
     * @return bool
     */
    public function isOverMaxUses()
    {
        if (is_null($this->max_uses)) {
            return false;
        }

        return $this->max_uses <= $this->uses;
    }

    public function getStartsAtFaAttribute()
    {
        return $this->starts_at ? Jalalian::fromDateTime($this->starts_at)->format('Y/m/d H:i') : '';
    }

    public function getExpiresAtFaAttribute()
    {
        return $this->expires_at ? Jalalian::fromDateTime($this->expires_at)->format('Y/m/d H:i') : '';
    }

    public function getIsOverMaxUsesAttribute()
    {
        return $this->isOverMaxUses();
    }

    public function newPrice($price)
    {
        if ($this->is_percent) {
            return (int) round($price - ($price * $this->discount_amount / 100), 0);
        }
        return (int) round($price - $this->discount_amount, 0);
    }
}
