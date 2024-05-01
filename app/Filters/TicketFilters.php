<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class TicketFilters extends QueryFilters
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
     * Filter by status.
     *
     * @param  string $status
     * @return Builder
     */
    public function status($status)
    {
        $status = json_decode($status);
        return $this->builder->where('status', $status->id);
    }

}
