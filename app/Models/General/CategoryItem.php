<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\UriForItems;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class CategoryItem extends Model
{
    use UriForItems, View, Filterable;

    protected $route_name = 'categories.categoryitems';

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Models\General\Category');
    }

    public static function scopeAsOption($query, $cat_id = null)
    {
        if (!is_null($cat_id)) {
            return $query->select('title as name', 'id')->where('category_id', $cat_id)->get();
        }

        return $query->select('title as name', 'id')->get();
    }

    public static function scopeAsOptionByKey($query, $cat_id = null)
    {
        if (!is_null($cat_id)) {
            return $query->select('title as name', 'key as id')->where('category_id', $cat_id)->get();
        }

        return $query->select('title as name', 'key as id')->get();
    }

    public static function scopeAsOptionForMultiselect($query)
    {
        return $query->select('id', 'category_id', 'title as name')->get();
    }

    public static function scopeAsOptionForMultiselectForSelectedCustomers($query)
    {
        return $query->select(['id', 'category_id'])
            ->selectRaw('concat("[" ,category_id, "__", id, "] ", title) as name')
            ->get();
    }

    public function contents()
    {
        return $this->hasMany('App\Models\General\Content');
    }

    public function products()
    {
        return $this->hasMany('App\Models\General\Product');
    }

    public function getProductsUrlAttribute()
    {
        return implode('/', ['', 'fa', 'products', $this->category_id, $this->id]);
    }
}
