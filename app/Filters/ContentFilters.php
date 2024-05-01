<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use App\Filters\Traits\LocaleFilter;
use Illuminate\Database\Eloquent\Builder;

class ContentFilters extends QueryFilters
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
     * Filter by summary.
     *
     * @param  string $summary
     * @return Builder
     */
    public function summary($summary)
    {
        return $this->builder->where('summary', 'like', '%' . $summary . '%');
    }

    /**
     * Filter by body.
     *
     * @param  string $body
     * @return Builder
     */
    public function body($body)
    {
        return $this->builder->where('body', 'like', '%' . $body . '%');
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

}
