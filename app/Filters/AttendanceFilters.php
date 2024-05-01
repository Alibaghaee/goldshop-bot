<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class AttendanceFilters extends QueryFilters
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
     * Filter by admin.
     *
     * @param  string $admin
     * @return Builder
     */
    public function admin($admin)
    {
        $admin = json_decode($admin);
        return $this->builder->where('admin_id', $admin->id);
    }

    /**
     * Filter by entry_date min.
     *
     * @param  string $entry_date
     * @return Builder
     */
    public function entry_date_min($entry_date)
    {
        return $this->builder->whereDate('entry_date', '>=', $entry_date);
    }

    /**
     * Filter by entry_date max.
     *
     * @param  string $entry_date
     * @return Builder
     */
    public function entry_date_max($entry_date)
    {
        return $this->builder->whereDate('entry_date', '<=', $entry_date);
    }

}
