<?php

namespace App\Filters\Traits;

trait LocaleFilter
{
    /**
     * Filter by locale_id
     *
     * @param  integer $locale
     * @return Builder
     */
    public function locale($locale)
    {
        $locale = json_decode($locale);
        return $this->builder->where('locale_id', $locale->id);
    }
}
