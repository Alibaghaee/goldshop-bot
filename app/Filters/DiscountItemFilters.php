<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class DiscountItemFilters extends QueryFilters
{
    use GlobalFilters;

    /**
     * Filter by code.
     *
     * @param  string $code
     * @return Builder
     */
    public function code($code)
    {
        return $this->builder->where('code', 'like', '%' . $code . '%');
    }

    /**
     * Filter by valid.
     *
     * @param  string $valid
     * @return Builder
     */
    public function valid($valid)
    {
        $valid = ($valid == 'true') ? true : false;

        if ($valid) {
            return $this->builder->whereRaw('uses < max_uses');
        }else{
            return $this->builder->whereRaw('uses = max_uses');
        }
    }

}
