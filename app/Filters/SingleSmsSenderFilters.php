<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class SingleSmsSenderFilters extends QueryFilters
{
    use GlobalFilters;

    /**
     * Filter by description.
     *
     * @param string $description
     * @return Builder
     */
    public function description($description)
    {
        return $this->builder->where('description', 'like', '%' . $description . '%');
    }

    /**
     * Filter by response.
     *
     * @param string $response
     * @return Builder
     */
    public function response($response)
    {
        return $this->builder->where('response', 'like', '%' . $response . '%');
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
     * Filter by contact_number_id.
     *
     * @param string $contact_number_id
     * @return Builder
     */
    public function contact_number_id($contact_number_id)
    {
        return $this->builder->where('contact_number_id', $contact_number_id);
    }

    /**
     * Filter by sender_number_id.
     *
     * @param string $sender_number_id
     * @return Builder
     */
    public function sender_number_id($sender_number_id)
    {
        return $this->builder->where('sender_number_id', $sender_number_id);
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

}
