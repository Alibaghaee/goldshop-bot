<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class AdminFilters extends QueryFilters
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
     * Filter by level.
     *
     * @param  string $level
     * @return Builder
     */
    public function level($level)
    {
        $level = json_decode($level);
        return $this->builder->where('level_id', $level->id);
    }

    /**
     * Filter by role.
     *
     * @param  string $role
     * @return Builder
     */
    public function role($role)
    {
        $role = json_decode($role);
        return $this->builder->where('role_id', $role->id);
    }

    /**
     * Filter by username.
     *
     * @param  string $role
     * @return Builder
     */
    public function username($username)
    {
        return $this->builder->where('username', 'like', '%' . $username . '%');
    }

}
