<?php

namespace App\Filters\Traits;

trait GlobalFilters
{
    /**
     * Sort by given values.
     *
     * @param  string $info
     * @return Builder
     */
    public function sort($info)
    {
        $info = explode('|', $info);
        if (count($info) == 2) {
            return $this->builder->orderBy(array_get($info, 0), array_get($info, 1));
        }
    }
}
