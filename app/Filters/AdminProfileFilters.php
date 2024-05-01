<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class AdminProfileFilters extends QueryFilters
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
        return $this->builder->whereHas('admin', function (Builder $query) use ($name) {


            $query->where('name', 'like', '%' . $name . '%');
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
        return $this->builder->whereHas('admin', function (Builder $query) use ($username) {


            $query->where('username', 'like', '%' . $username . '%');
        });
    }

    /**
     * Filter by email.
     *
     * @param string $email
     * @return Builder
     */
    public function email($email)
    {
        return $this->builder->whereHas('admin', function (Builder $query) use ($email) {


            $query->where('email', 'like', '%' . $email . '%');
        });
    }

}
