<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class ContractFilters extends QueryFilters
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
     * Filter by customer.
     *
     * @param  string $customer
     * @return Builder
     */
    public function customer($customer)
    {
        $customer = json_decode($customer);
        return $this->builder->where('customer_id', $customer->id);
    }

    /**
     * Filter by is_pattern.
     *
     * @param  boolean $is_pattern
     * @return Builder
     */
    public function is_pattern($is_pattern)
    {
        $is_pattern = ($is_pattern == 'true') ? true : false;
        return $this->builder->where('is_pattern', $is_pattern);
    }

}
