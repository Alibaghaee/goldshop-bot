<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class ReceivedLetterFilters extends QueryFilters
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
     * Filter by date min.
     *
     * @param  string $date
     * @return Builder
     */
    public function date_min($date)
    {
        return $this->builder->whereDate('date', '>=', $date);
    }

    /**
     * Filter by date max.
     *
     * @param  string $date
     * @return Builder
     */
    public function date_max($date)
    {
        return $this->builder->whereDate('date', '<=', $date);
    }

}
