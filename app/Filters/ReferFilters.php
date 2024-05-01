<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class ReferFilters extends QueryFilters
{
    use GlobalFilters;

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

    /**
     * Filter by from_admin_id.
     *
     * @param  string $from_admin_id
     * @return Builder
     */
    public function from_admin_id($from_admin_id)
    {
        $from_admin_id = json_decode($from_admin_id);
        return $this->builder->where('from_admin_id', $from_admin_id->id);
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
     * Filter by referred.
     *
     * @param  string $referred
     * @return Builder
     */
    public function referred($referred)
    {
        $referred = json_decode($referred);

        return $this->builder->where('referred', $referred->id);
    }

}
