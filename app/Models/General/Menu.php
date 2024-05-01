<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\ModelsScope\Traits\DomainScopeTrait;
use App\Traits\Models\Locale;
use App\Traits\Models\Removable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use Uri, View, Filterable, DomainScopeTrait, Removable, Locale;

    protected $route_name = 'menus';

    protected $guarded = [];

    protected $appends = ['index_uri', 'item_create_uri', 'order_uri'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($menu) {
            $menu->items->each->delete();
        });

        static::saving(function ($model) {
            $model->locale_id = 1;
        });

        static::creating(function ($model) {
            $model->locale_id = 1;
        });
    }

    public function items()
    {
        return $this->hasMany('App\Models\General\MenuItem')->orderBy('order');
    }

    public function patentItems()
    {
        return $this->items()->whereNull('parent_item_id')->orderBy('order');
    }

    public function getItemsUriAttribute()
    {
        return route('menus.menu_items.index', ['menu' => $this->id]);
    }

    public function getItemCreateUriAttribute()
    {
        return route('menus.menu_items.create', ['menu' => $this->id]);
    }

    public function getOrderUriAttribute()
    {
        return route('menus.order.index', ['menu' => $this->id]);
    }

    public static function getMenu($id)
    {
        return static::with(['items' => function ($query) {
            $query->where('active', true)->where('parent_item_id', null)->orderBy('order', 'desc');
        }])->findOrFail($id);
    }

}
