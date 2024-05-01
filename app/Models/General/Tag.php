<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'tags';

    protected $guarded = [];

    protected $appends = ['link'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('title', 'desc');
        });
    }

    public static function scopeAsOption($query)
    {
        return $query->select('tags.id', 'title as name')->get();
    }

    /**
     * Get all of the products that are assigned this tag.
     */
    public function products()
    {
        return $this->morphedByMany('App\Models\General\Product', 'taggable');
    }

    public function getLinkAttribute()
    {
        return '/' . app()->getLocale() . '/tag/' . $this->slug;
    }

    public function getLinkForContentAttribute()
    {
        return '/' . app()->getLocale() . '/tag/content/' . $this->slug;
    }

    // {{dont_delete_this_comment}}
}
