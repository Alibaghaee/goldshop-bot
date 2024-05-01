<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class TabiatCodeFilters extends QueryFilters
{
    use GlobalFilters;

    /**
     * Filter by code.
     *
     * @param  integer $code
     * @return Builder
     */
    public function code($code)
    {
        return $this->builder->where('code', $code);
    }

    /**
     * Filter by refrence_id.
     *
     * @param  string $refrence_id
     * @return Builder
     */
    public function refrence_id($refrence_id)
    {
        return $this->builder->where('refrence_id', $refrence_id);
    }

    /**
     * Filter by tabiat_product.
     *
     * @param  string $tabiat_product
     * @return Builder
     */
    public function tabiat_product($tabiat_product)
    {
        $tabiat_product = json_decode($tabiat_product);

        return $this->builder->where('tabiat_product_id', $tabiat_product->id);
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

    /**
     * Filter by profile_id.
     *
     * @param  integer $profile_id
     * @return Builder
     */
    public function profile_id($profile_id)
    {
        return $this->builder->where('member_id', $profile_id);
    }

    /**
     * Filter by utilization_date min.
     *
     * @param  string $utilization_date
     * @return Builder
     */
    public function utilization_date_min($utilization_date)
    {
        return $this->builder->where('utilization_date', '>=', new \DateTime($utilization_date));
    }

    /**
     * Filter by utilization_date max.
     *
     * @param  string $utilization_date
     * @return Builder
     */
    public function utilization_date_max($utilization_date)
    {
        return $this->builder->where('utilization_date', '<=', new \DateTime($utilization_date));
    }

    





    

}
