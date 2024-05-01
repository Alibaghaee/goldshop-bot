<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\UriForItems;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class MenuItem extends Model
{
    use UriForItems, View, Filterable;

    protected $route_name = 'menus.menu_items';

    protected $guarded = [];
    protected $appends = ['created_at_fa'];

    public function menu()
    {
        return $this->belongsTo('App\Models\General\Menu');
    }

    public function children()
    {
        return $this->hasMany('App\Models\General\MenuItem', 'parent_item_id')
            ->select('parent_item_id', 'title', 'id', 'link')
            ->orderBy('order');
    }

    public function getCreatedAtFaAttribute()
    {
        return Jalalian::fromDateTime($this->created_at)->format('d - M - Y');
    }

}
