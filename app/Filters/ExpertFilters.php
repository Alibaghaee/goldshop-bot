<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class ExpertFilters extends QueryFilters
{
    use GlobalFilters;

    /**
     * Filter by name.
     *
     * @param  string $name
     * @return Builder
     */
    public function name($name)
    {
        return $this->builder->where('name', 'like', '%' . $name . '%');
    }

    /**
     * Filter by family.
     *
     * @param  string $family
     * @return Builder
     */
    public function family($family)
    {
        return $this->builder->where('family', 'like', '%' . $family . '%');
    }

    /**
     * Filter by mobile.
     *
     * @param  string $mobile
     * @return Builder
     */
    public function mobile($mobile)
    {
        return $this->builder->where('mobile', 'like', '%' . $mobile . '%');
    }

    /**
     * Filter by phone.
     *
     * @param  string $phone
     * @return Builder
     */
    public function phone($phone)
    {
        return $this->builder->where('phone', 'like', '%' . $phone . '%');
    }

    /**
     * Filter by department.
     *
     * @param  string $department
     * @return Builder
     */
    public function department($department)
    {
        $department = json_decode($department);
        return $this->builder->where('department_id', $department->id);
    }

}
