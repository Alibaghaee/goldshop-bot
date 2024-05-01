<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Locale;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use Uri, View, Filterable, Locale;

    protected $route_name = 'galleries';

    protected $guarded = [];

    protected $appends = ['index_uri', 'item_create_uri', 'order_uri'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($gallery) {
            $gallery->items->each->delete();
        });
    }

    public function category_item()
    {
        return $this->belongsTo('App\Models\General\CategoryItem', 'category_item_id');
    }

    public function items()
    {
        return $this->hasMany('App\Models\General\GalleryItem')->isActive();
    }

    public function getItemsUriAttribute()
    {
        return route('galleries.gallery_items.index', ['gallery' => $this->id]);
    }

    public function getItemCreateUriAttribute()
    {
        return route('galleries.gallery_items.create', ['gallery' => $this->id]);
    }

    public function getOrderUriAttribute()
    {
        return route('menus.order.index', ['menu' => $this->id]);
    }

    public function scopeIsActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeLocale($query)
    {
        return $query->where('locale_id', session('locale_id'));
    }

    public function getUrlAttribute()
    {
        return '/' . $this->locale_name . '/gallery/' . $this->id;
    }

}
