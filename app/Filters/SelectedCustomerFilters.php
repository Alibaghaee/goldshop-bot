<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class SelectedCustomerFilters extends QueryFilters
{
    use GlobalFilters;

    /**
     * Filter by customer_fullname.
     *
     * @param  string $customer_fullname
     * @return Builder
     */
    public function customer_fullname($customer_fullname)
    {
        return $this->builder->where('customer_fullname', 'like', '%' . $customer_fullname . '%');
    }

    /**
     * Filter by customer_code.
     *
     * @param  string $customer_code
     * @return Builder
     */
    public function customer_code($customer_code)
    {
        return $this->builder->where('customer_code', 'like', $customer_code);
    }

}
