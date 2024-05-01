<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use App\Filters\Traits\LocaleFilter;
use Illuminate\Database\Eloquent\Builder;

class SettingFilters extends QueryFilters
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
     * Filter by type.
     *
     * @param  string $type
     * @return Builder
     */
    public function type($type)
    {
        $type = json_decode($type);
        return $this->builder->where('type', $type->id);
    }

}
