<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilters extends QueryFilters
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
     * Filter by module.
     *
     * @param  string $module
     * @return Builder
     */
    public function module($module)
    {
        $module = json_decode($module);
        return $this->builder->where('module_id', $module->id);
    }

}
