<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class TravelFilters extends QueryFilters
{
    use GlobalFilters;

    /**
     * Filter by beginning.
     *
     * @param string $beginning
     * @return Builder
     */
    public function beginning($beginning)
    {
        return $this->builder->where('beginning', 'like', '%' . $beginning . '%');
    }

    /**
     * Filter by destination.
     *
     * @param string $destination
     * @return Builder
     */
    public function destination($destination)
    {
        return $this->builder->where('destination', 'like', '%' . $destination . '%');
    }

    /**
     * Filter by time_return_from.
     *
     * @param string $time_return_from
     * @return Builder
     */
    public function time_return_from($time_return_from)
    {
        return $this->builder->where('time_return', '>=', new \DateTime($time_return_from));
    }

    /**
     * Filter by time_return_to.
     *
     * @param string $time_return_to
     * @return Builder
     */
    public function time_return_to($time_return_to)
    {
        return $this->builder->where('time_return', '<=', new \DateTime($time_return_to));
    }


    /**
     * Filter by beginning_time_from.
     *
     * @param string $beginning_time_from
     * @return Builder
     */
    public function beginning_time_from($beginning_time_from)
    {
        return $this->builder->where('beginning_time', '>=', new \DateTime($beginning_time_from));
    }

    /**
     * Filter by beginning_time_to.
     *
     * @param string $beginning_time_to
     * @return Builder
     */
    public function beginning_time_to($beginning_time_to)
    {
        return $this->builder->where('beginning_time', '<=', new \DateTime($beginning_time_to));
    }

    /**
     * Filter by reason.
     *
     * @param string $reason
     * @return Builder
     */
    public function reason($reason)
    {

        return $this->builder->where('reason', optional(json_decode($reason))->name);
    }

    /**
     * Filter by accompanying_person.
     *
     * @param string $accompanying_person
     * @return Builder
     */
    public function accompanying_person($accompanying_person)
    {

        return $this->builder->where('accompanying_person', optional(json_decode($accompanying_person))->name);
    }

    /**
     * Filter by reason.
     *
     * @param string $tracking_code
     * @return Builder
     */
    public function tracking_code($tracking_code)
    {

        return $this->builder->where('tracking_code', 'like','%' . to_english_numbers($tracking_code) . '%');
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

            return $this->builder->where('status', 'like', '%' . json_decode($status)->id . '%');
        }
        return $this->builder;
    }


    /**
     * Filter by subscrip_code.
     *
     * @param string $subscrip_code
     * @return Builder
     */
    public function subscrip_code($subscrip_code)
    {
        return $this->builder->whereHas('user', function ($query) use ($subscrip_code) {

            $query->where('subscrip_code', 'like', '%' . $subscrip_code . '%');
        });


    }


    /**
     * Filter by username.
     *
     * @param string $username
     * @return Builder
     */
    public function username($username)
    {
        return $this->builder->whereHas('user', function ($query) use ($username) {

            $query->where('name', 'like', '%' . $username . '%');
            $query->where('family', 'like', '%' . $username . '%');
        });


    }

    /**
     * Filter by drivername.
     *
     * @param string $drivername
     * @return Builder
     */
    public function drivername($drivername)
    {
        return $this->builder->whereHas('driver', function ($query) use ($drivername) {

            $query->where('first_name', 'like', '%' . $drivername . '%');
            $query->where('last_name', 'like', '%' . $drivername . '%');
        });


    }

}
