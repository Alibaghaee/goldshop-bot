<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class ContactFilters extends QueryFilters
{
    use GlobalFilters;

    /**
     * Filter by fullname.
     *
     * @param  string $fullname
     * @return Builder
     */
    public function fullname($fullname)
    {
        return $this->builder->where('fullname', 'like', '%' . $fullname . '%');
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
     * Filter by ip.
     *
     * @param  string $ip
     * @return Builder
     */
    public function ip($ip)
    {
        return $this->builder->where('ip', 'like', '%' . $ip . '%');
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

    

}
