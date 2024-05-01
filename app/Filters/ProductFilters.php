<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use App\Filters\Traits\LocaleFilter;
use App\Models\General\CategoryItem;
use App\Models\General\Tag;
use Illuminate\Database\Eloquent\Builder;

class ProductFilters extends QueryFilters
{
    use GlobalFilters, LocaleFilter;

    /**
     * Filter by title.
     *
     * @param  string $title
     * @return Builder
     */
    public function title($title)
    {
        return $this->builder->where('title', 'like', '%' . $title . '%');
    }

    /**
     * Filter by code.
     *
     * @param  string $code
     * @return Builder
     */
    public function code($code)
    {
        return $this->builder->where('code', 'like', '%' . $code . '%');
    }

    /**
     * Filter by price.
     *
     * @param  string $price
     * @return Builder
     */
    public function price($price)
    {
        return $this->builder->where('price', $price);
    }

    /**
     * Filter by description.
     *
     * @param  string $description
     * @return Builder
     */
    public function description($description)
    {
        return $this->builder->where('description', 'like', '%' . $description . '%');
    }

    /**
     * Filter by detail.
     *
     * @param  string $detail
     * @return Builder
     */
    public function detail($detail)
    {
        return $this->builder->where('detail', 'like', '%' . $detail . '%');
    }

    /**
     * Filter by active.
     *
     * @param  boolean $active
     * @return Builder
     */
    public function active($active)
    {
        $active = ($active == 'true') ? true : false;
        return $this->builder->where('active', $active);
    }

    /**
     * Filter by new.
     *
     * @param  boolean $new
     * @return Builder
     */
    function new ($new) {
        $new = ($new == 'true') ? true : false;
        return $this->builder->where('new', $new);
    }

    /**
     * Filter by category.
     *
     * @param  integer $category
     * @return Builder
     */
    public function category($category)
    {
        $category = json_decode($category);
        return $this->builder->where('category_item_id', $category->id);
    }

    /**
     * Filter by tag with OR logic.
     *
     * @param  string $tags
     * @return Builder
     */
    public function tag_or($tags)
    {
        $tags    = json_decode($tags, true);
        $tags_id = Arr::pluck($tags, 'id');

        return $this->builder->with('tags')
            ->whereHas('tags', function ($query) use ($tags_id) {
                $query->whereIn('tag_id', $tags_id);
            });
    }

    /**
     * Filter by tag with AND logic.
     *
     * @param  string $tags
     * @return Builder
     */
    public function tags($tags)
    {
        $tags                 = json_decode($tags, true);
        $category_items_id    = array_keys(array_filter($tags));
        $category_items_group = CategoryItem::whereIn('id', $category_items_id)->get()->groupBy('category_id');

        foreach ($category_items_group as $category_items) {
            $tags_title = $category_items->pluck('title');
            $tags_id    = Tag::whereIn('title', $tags_title)->pluck('id');

            $this->builder
                ->whereHas('tags', function ($query) use ($tags_id) {
                    $query->whereIn('tag_id', $tags_id);
                });
        }
        return $this->builder;
    }

}
