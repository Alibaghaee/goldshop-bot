<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class CustomerFilters extends QueryFilters
{
    use GlobalFilters;

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

    /**
     * Filter by group.
     *
     * @param  string $group
     * @return Builder
     */
    public function group($group)
    {
        $group = json_decode($group);
        return $this->builder->where('group_id', $group->id);
    }

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
     * Filter by company_name.
     *
     * @param  string $company_name
     * @return Builder
     */
    public function company_name($company_name)
    {
        return $this->builder->where('company_name', 'like', '%' . $company_name . '%');
    }

    /**
     * Filter by email.
     *
     * @param  string $email
     * @return Builder
     */
    public function email($email)
    {
        return $this->builder->where('email', 'like', '%' . $email . '%');
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
     * Filter by created_at min.
     *
     * @param  string $created_at
     * @return Builder
     */
    public function created_at_min($created_at)
    {
        return $this->builder->whereDate('created_at', '>=', $created_at);
    }

    /**
     * Filter by created_at max.
     *
     * @param  string $created_at
     * @return Builder
     */
    public function created_at_max($created_at)
    {
        return $this->builder->whereDate('created_at', '<=', $created_at);
    }

    /**
     * Filter by creator.
     *
     * @param  string $creator
     * @return Builder
     */
    public function creator($creator)
    {
        $creator = json_decode($creator);
        return $this->builder->where('admin_id', $creator->id);
    }

}
