<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class ContactNumberFilters extends QueryFilters
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
        return $this->builder->where('name', 'like', '%' . $name . '%');
    }

    /**
     * Filter by en_name.
     *
     * @param string $en_name
     * @return Builder
     */
    public function en_name($en_name)
    {
        return $this->builder->where('en_name', 'like', '%' . $en_name . '%');
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

    /**
     * Filter by status.
     *
     * @param string $status
     * @return Builder
     */
    public function status($status)
    {
        if (isset(json_decode($status)->id)) {

            return $this->builder->where('status', json_decode($status)->id);
        }
        return $this->builder;
    }

    /**
     * Filter by gender.
     *
     * @param string $gender
     * @return Builder
     */
    public function gender($gender)
    {
        if (isset(json_decode($gender)->id)) {

            return $this->builder->where('gender', json_decode($gender)->id);
        }
        return $this->builder;
    }


    /**
     * Filter by contact_category_id.
     *
     * @param string $contact_category_id
     * @return Builder
     */
    public function contact_category_id($contact_category_id)
    {
        return $this->builder->where('contact_category_id', $contact_category_id);
    }

}
