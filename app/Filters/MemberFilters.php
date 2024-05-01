<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class MemberFilters extends QueryFilters
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
     * Filter by birth_date min.
     *
     * @param  string $birth_date
     * @return Builder
     */
    public function birth_date_min($birth_date)
    {
        return $this->builder->whereDate('birth_date', '>=', $birth_date);
    }

    /**
     * Filter by birth_date max.
     *
     * @param  string $birth_date
     * @return Builder
     */
    public function birth_date_max($birth_date)
    {
        return $this->builder->whereDate('birth_date', '<=', $birth_date);
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
     * Filter by province.
     *
     * @param  string $province
     * @return Builder
     */
    public function province($province)
    {
        $province = json_decode($province);
        return $this->builder->where('province_id', $province->id);
    }

    /**
     * Filter by city.
     *
     * @param  string $city
     * @return Builder
     */
    public function city($city)
    {
        $city = json_decode($city);
        return $this->builder->where('city_id', $city->id);
    }

    /**
     * Filter by complete.
     *
     * @param  string $complete
     * @return Builder
     */
    public function complete($complete)
    {
        $complete = ($complete == 'true') ? true : false;
        return $this->builder->where('complete', $complete);
    }

    /**
     * Filter by blacklist.
     *
     * @param  string $blacklist
     * @return Builder
     */
    public function blacklist($blacklist)
    {
        $blacklist = ($blacklist == 'true') ? true : false;
        return $this->builder->where('blacklist', $blacklist);
    }

}
