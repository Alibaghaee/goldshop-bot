<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class DriverFilters extends QueryFilters
{
    use GlobalFilters;

    /**
     * Filter by name.
     *
     * @param string $name
     * @return Builder
     */
    public function name($name)
    {
        return $this->builder->where('first_name', 'like', '%' . $name . '%')
            ->orWhere('last_name', 'like', '%' . $name . '%');
    }

    /**
     * Filter by first_name.
     *
     * @param string $first_name
     * @return Builder
     */
    public function first_name($first_name)
    {
        return $this->builder->where('first_name', 'like', '%' . $first_name . '%');
    }

    /**
     * Filter by last_name.
     *
     * @param string $last_name
     * @return Builder
     */
    public function last_name($last_name)
    {
        return $this->builder->where('last_name', 'like', '%' . $last_name . '%');
    }

    /**
     * Filter by organization_code.
     *
     * @param string $organization_code
     * @return Builder
     */
    public function organization_code($organization_code)
    {
        return $this->builder->where('organization_code', 'like', '%' . $organization_code . '%');
    }

    /**
     * Filter by mobile.
     *
     * @param string $mobile
     * @return Builder
     */
    public function mobile($mobile)
    {
        return $this->builder->where('mobile', 'like', '%' . $mobile . '%');
    }

}
