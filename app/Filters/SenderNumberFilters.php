<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class SenderNumberFilters extends QueryFilters
{
    use GlobalFilters;

    /**
     * Filter by number.
     *
     * @param string $number
     * @return Builder
     */
    public function number($number)
    {
        return $this->builder->where('number', 'like', '%' . $number . '%');
    }


    /**
     * Filter by domain.
     *
     * @param string $domain
     * @return Builder
     */
    public function domain($domain)
    {

        if (isset(json_decode($domain)->id)) {

            return $this->builder->whereHas('panelSms', function ($query) use ($domain) {

                $query->where('domain', json_decode($domain)->id);
            });
        }
        return $this->builder;
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
     * Filter by type.
     *
     * @param string $type
     * @return Builder
     */
    public function type($type)
    {


        if (isset(json_decode($type)->id)) {

            return $this->builder->where('type', json_decode($type)->id);
        }
        return $this->builder;
    }

    /**
     * Filter by dargah.
     *
     * @param string $dargah
     * @return Builder
     */
    public function dargah($dargah)
    {


        if (isset(json_decode($dargah)->id)) {

            return $this->builder->where('dargah', json_decode($dargah)->id);
        }
        return $this->builder;
    }
}
