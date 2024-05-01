<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use App\Models\General\Map;
use Illuminate\Database\Eloquent\Builder;

class NetworkActivityFilters extends QueryFilters
{
//    use GlobalFilters;

    /**
     * Filter by title.
     *
     * @param string $title
     * @return Builder
     */
    public function title($title)
    {
        return $this->builder->where('title', 'like', '%' . $title . '%');
    }

    /**
     * Filter by shop_code.
     *
     * @param string $shop_code
     * @return Builder
     */
    public function shop_code($shop_code)
    {

        return $this->builder
            ->select('network_activities.*')
            ->leftJoin('maps', 'network_activities.network_activitiable_id', '=', 'maps.id')
            ->where('network_activities.network_activitiable_type', '=', Map::class)
            ->where('maps.code', 'like', '%' .  $shop_code. '%');
    }


    /**
     * Filter by created_at min.
     *
     * @param string $created_at
     * @return Builder
     */
    public function created_at_min($created_at)
    {
        return $this->builder->where('created_at', '>=', new \DateTime($created_at));
    }

    /**
     * Filter by created_at max.
     *
     * @param string $created_at
     * @return Builder
     */
    public function created_at_max($created_at)
    {
        return $this->builder->where('created_at', '<=', new \DateTime($created_at));
    }

}
