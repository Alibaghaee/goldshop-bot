<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class TabiatProductFilters extends QueryFilters
{
    use GlobalFilters;

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
     * Filter by tabiat_product_category.
     *
     * @param  string $tabiat_product_category
     * @return Builder
     */
    public function tabiat_product_category($tabiat_product_category)
    {
        $tabiat_product_category = json_decode($tabiat_product_category);
        return $this->builder->where('tabiat_product_category_id', $tabiat_product_category->id);
    }

}
