<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class BlacklistFilters extends QueryFilters
{
    use GlobalFilters;

    /**
     * Filter by id.
     *
     * @param  integer $id
     * @return Builder
     */
    public function id($id)
    {
        return $this->builder->where('id', $id);
    }

    /**
     * Filter by message.
     *
     * @param  string $message
     * @return Builder
     */
    public function message($message)
    {
        return $this->builder->where('message', 'like', '%' . $message . '%');
    }

    /**
     * Filter by user_id.
     *
     * @param  string $user_id
     * @return Builder
     */
    public function user_id($user_id)
    {
        return $this->builder->where('user_id', $user_id);
    }

    /**
     * Filter by admin_id.
     *
     * @param  string $admin_id
     * @return Builder
     */
    public function admin_id($admin_id)
    {
        return $this->builder->where('admin_id', $admin_id);
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
     * Filter by blacklist_type.
     *
     * @param  string $blacklist_type
     * @return Builder
     */
    public function blacklist_type($blacklist_type)
    {
        $blacklist_type = json_decode($blacklist_type);
        return $this->builder->where('blacklist_type', $blacklist_type->id);
    }

    /**
     * Filter by date min.
     *
     * @param  string $date
     * @return Builder
     */
    public function date_min($date)
    {
        return $this->builder->where('date', '>=', strtotime($date));
    }

    /**
     * Filter by date max.
     *
     * @param  string $date
     * @return Builder
     */
    public function date_max($date)
    {
        return $this->builder->where('date', '<=', strtotime($date));
    }

    /**
     * Filter by table_name.
     *
     * @param  string $table_name
     * @return Builder
     */
    public function table_name($table_name)
    {
        return $this->builder->where('table_name', $table_name);
    }

    /**
     * Filter by staff_id.
     *
     * @param  string $staff_id
     * @return Builder
     */
    public function staff_id($staff_id)
    {
        return $this->builder->where('staff_id', $staff_id);
    }

    /**
     * Filter by send_type.
     *
     * @param  string $send_type
     * @return Builder
     */
    public function send_type($send_type)
    {
        return $this->builder->where('send_type', $send_type);
    }

}
