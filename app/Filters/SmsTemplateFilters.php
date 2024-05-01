<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class SmsTemplateFilters extends QueryFilters
{
    use GlobalFilters;

    /**
     * Filter by title.
     *
     * @param string $title
     * @return Builder
     */
    public function title($title)
    {
        return $this->builder->where('title', 'like', '%' . $title . '%');
    }

    /**
     * Filter by description.
     *
     * @param string $description
     * @return Builder
     */
    public function description($description)
    {
        return $this->builder->where('description', 'like', '%' . $description . '%');
    }

    /**
     * Filter by tag.
     *
     * @param string $tag
     * @return Builder
     */
    public function tag($tag)
    {

        return $this->builder->where('tag', optional(json_decode($tag))->name);
    }

}
