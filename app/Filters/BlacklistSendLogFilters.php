<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class BlacklistSendLogFilters extends QueryFilters
{
    use GlobalFilters;

    /**
     * Filter by note.
     *
     * @param  string $note
     * @return Builder
     */
    public function note($note)
    {
        return $this->builder->where('note', 'like', '%' . $note . '%');
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

    /**
     * Filter by blacklist_id.
     *
     * @param  string $blacklist_id
     * @return Builder
     */
    public function blacklist_id($blacklist_id)
    {
        return $this->builder->where('blacklist_id', $blacklist_id);
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

}
