<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class SmsSendFilters extends QueryFilters
{
    use GlobalFilters;

    /**
     * Filter by id.
     *
     * @param  string $id
     * @return Builder
     */
    public function id($id)
    {
        return $this->builder->where('id', $id);
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
     * Filter by sender.
     *
     * @param  string $sender
     * @return Builder
     */
    public function sender($sender)
    {
        return $this->builder->where('sender', $sender);
    }

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
     * Filter by created_at min.
     *
     * @param  string $created_at
     * @return Builder
     */
    public function created_at_min($created_at)
    {
        return $this->builder->where('created_at', '>=', new \DateTime($created_at));
    }

    /**
     * Filter by created_at max.
     *
     * @param  string $created_at
     * @return Builder
     */
    public function created_at_max($created_at)
    {
        return $this->builder->where('created_at', '<=', new \DateTime($created_at));
    }

}
