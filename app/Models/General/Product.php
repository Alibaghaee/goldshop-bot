<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\ModelsScope\Traits\DomainScopeTrait;
use App\Traits\Models\Locale;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Product extends Model implements Buyable
{
    use Uri, View, Filterable, DomainScopeTrait, Locale;

    protected $route_name = 'products';

    protected $guarded = [];

    protected $appends = ['index_uri', 'item_create_uri', 'order_uri', 'url', 'detail_substr', 'product_show_page', 'video_count', 'article_count'];

    public function category_item()
    {
        return $this->belongsTo('App\Models\General\CategoryItem', 'category_item_id');
    }

    public static function createProduct($data)
    {
        $tags = Arr::get($data, 'tags', []);
        // delete tags index
        unset($data['tags']);

        $data   = multiselect_adapter($data);
        $fields = Arr::get($data, 'fields');
        $data   = Arr::except($data, ['fields']);

        $data['address_slug'] = Str::slug($data['address_slug'] ?: $data['html_title']);
        $product              = static::create($data);

        $product->syncTags($tags);
        $product->fields()->sync($fields);
    }

    public function updateProduct($data)
    {
        // update tags
        $tags = array_get($data, 'tags', []);
        $this->syncTags($tags);
        // delete tags index
        unset($data['tags']);

        $data   = multiselect_adapter($data);
        $fields = Arr::get($data, 'fields');
        $data   = Arr::except($data, ['fields']);
        $this->fields()->sync($fields);

        $data['address_slug'] = Str::slug($data['address_slug'] ?: $data['html_title']);
        $this->update($data);
    }

    public function scopeIsActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeIsNew($query)
    {
        return $query->where('new', true);
    }

    public function scopeWhereSlug($query, $slug)
    {
        return $query->where('address_slug', $slug);
    }

    public function scopeLocale($query)
    {
        return $query->where('locale_id', session('locale_id'));
    }

    public static function getBySlug($slug)
    {
        return static::locale()->whereSlug($slug)->limitedByField()->isActive()->firstOrFail();
    }

    public function getLocaleIdAttribute()
    {
        return 1;
    }

    public function getUrlAttribute()
    {
        return '/' . $this->locale_name . '/product/' . $this->address_slug;
    }

    public function getDetailArrayAttribute()
    {
        return array_filter(array_slice(explode("\n", $this->detail), 0, 4));
    }

    public function getPriceNumberFormatAttribute()
    {
        if (is_numeric($this->price)) {
            return number_format($this->price);
        }
        return $this->price;
    }

    /**
     * Get all of the tags for the product.
     */
    public function tags()
    {
        return $this->morphToMany('App\Models\General\Tag', 'taggable')->withTimestamps();
    }

    public function syncTags($tags)
    {
        $tags_id = Arr::pluck($tags, 'id');
        return $this->tags()->sync($tags_id);
    }

    public function items()
    {
        return $this->hasMany('App\Models\General\ProductItem');
    }

    public function getOrderUriAttribute()
    {
        return route('products.order.index', ['product' => $this->id]);
    }

    public function getItemsUriAttribute()
    {
        return route('products.product_items.index', ['product' => $this->id]);
    }

    public function getItemCreateUriAttribute()
    {
        return route('products.product_items.create', ['product' => $this->id]);
    }

    /**
     * Get the identifier of the Buyable item.
     *
     * @return int|string
     */
    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    /**
     * Get the description or title of the Buyable item.
     *
     * @return string
     */
    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }

    /**
     * Get the price of the Buyable item.
     *
     * @return float
     */
    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }

    public function getDetailSubstrAttribute($value, $length = 170)
    {
        return Str::limit($this->detail, $length);
    }

    public function getProductShowPageAttribute()
    {
        return route('dashboard.show', [app()->getLocale(), $this->id]);
    }

    public function getVideoCountAttribute()
    {
        return $this->items()->where('type', 1)->count();
    }

    public function getArticleCountAttribute()
    {
        return $this->items()->where('type', 2)->count();
    }

    public function fields()
    {
        return $this->belongsToMany('App\Models\General\StudyField')->withTimestamps();
    }

    public function scopeLimitedByField()
    {
        $fields_id = [
            auth()->user()->field_of_study,
        ];

        return $this->whereHas('fields', function ($query) use ($fields_id) {
            $query->whereIn('study_fields.id', $fields_id);
        });
    }

    public static function scopeAsOption($query)
    {
        return $query->select('products.id', 'title as name')->get();
    }

}
