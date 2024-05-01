<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class PanelSmsFilters extends QueryFilters
{
    use GlobalFilters;

    /**
     * Filter by domain.
     *
     * @param string $domain
     * @return Builder
     */
    public function domain($domain)
    {

        if (isset(json_decode($domain)->id)) {

            return $this->builder->where('domain', json_decode($domain)->id);
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
     * Filter by username.
     *
     * @param string $username
     * @return Builder
     */
    public function username($username)
    {
        return $this->builder->where('username', 'like', '%' . $username . '%');
    }

    /**
     * Filter by senderNumber.
     *
     * @param string $senderNumber
     * @return Builder
     */
    public function senderNumber($senderNumber)
    {
        return $this->builder->whereHas('senderNumbers', function (Builder $query) use ($senderNumber) {


            $query->where('number', 'like', '%' . $senderNumber . '%');
        });
    }

}
