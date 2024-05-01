<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\ModelsScope\Traits\DomainScopeTrait;
use App\Models\General\Module;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Category extends Model
{
    use Uri, View, Filterable, DomainScopeTrait;

    protected $route_name = 'categories';

    protected $guarded = [];

    protected $appends = ['index_uri', 'item_create_uri', 'order_uri'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            $category->items->each->delete();
        });
    }

    public static function scopeAsGroupOption($query, $module_id = null, $categoryId = null)
    {
        if (!is_null($module_id)) {
            return $query->when(!is_null($categoryId), function ($query) use ($categoryId) {

                $query->where('id', $categoryId);
            })
                ->with('items:id,category_id,title as name')
                ->select('title as name', 'id')
                ->where('categories.module_id', $module_id)
                ->get();
        }
        return $query->when(!is_null($categoryId), function ($query) use ($categoryId) {

            $query->where('id', $categoryId);
        })->with('items:id,category_id,title as name')
            ->select('title as name', 'id')->get();
    }

    public static function scopeAsGroupOptionForSelectedCustomers($query, $module_id = null)
    {
        if (!is_null($module_id)) {
            return $query
                ->with(['items' => function ($query) {
                    $query->select(['id', 'category_id'])->selectRaw('concat("[" ,category_id, "__", id, "] ", title) as name');
                }])
                ->selectRaw('concat("[", id, "] ", title) as name, id')
                ->where('categories.module_id', $module_id)
                ->get();
        }
        return $query->with('items:id,category_id,title as name')->select('title as name', 'id')->get();
    }

    public static function scopeAsOption($query)
    {
        return $query->select('categories.id', 'title as name')->get();
    }

    public function items()
    {
        return $this->hasMany('App\Models\General\CategoryItem');
    }

    public function contents()
    {
        return $this->hasManyThrough('App\Models\General\Content', 'App\Models\General\CategoryItem');
    }

    public function products()
    {
        return $this->hasManyThrough('App\Models\General\Product', 'App\Models\General\CategoryItem');
    }

    public function getItemsUriAttribute()
    {
        return route('categories.categoryitems.index', ['category' => $this->id]);
    }

    public function getItemCreateUriAttribute()
    {
        return route('categories.categoryitems.create', ['category' => $this->id]);
    }

    public function getOrderUriAttribute()
    {
        return route('categories.order.index', ['category' => $this->id]);
    }

    public function getFormPathAttribute()
    {
        $form = collect(config('portal.category_forms'))->where('module_id', $this->module_id)->first();
        $form_path = $form ? 'admin.modules.category_items.' . Arr::get($form, 'form') : 'admin.modules.category_items.form_create';

        return $form_path;
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

}
