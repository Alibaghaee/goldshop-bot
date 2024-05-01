<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use App\Filters\Traits\LocaleFilter;
use Illuminate\Database\Eloquent\Builder;
use Morilog\Jalali\CalendarUtils;

class ContentFiltersSite extends QueryFilters
{
    use GlobalFilters, LocaleFilter;

    /**
     * Filter by box.
     *
     * @param string $box
     * @return Builder
     */
    public function box($box)
    {
        return $this->builder->where('title', 'like', '%' . $box . '%')
            ->orWhere('body', 'like', '%' . $box . '%');
    }

    /**
     * Filter by category.
     *
     * @param integer $category
     * @return Builder
     */
    public function category_title($category_title)
    {
        return $this->builder->whereHas('category_item', function ($q) use ($category_title) {

            $q->where('title', 'like', '%' . $category_title . '%');
        });
    }
    /**
     * Filter by orderByViews.
     *
     * @param string $orderByViews
     * @return Builder
     */
    public function orderByViews($orderByViews)
    {

        return $this->builder->orderByDesc('views');
    }

    /**
     * Filter by trom.
     *
     * @param string $from
     * @return Builder
     */
    public function from($from)
    {

        $l = explode('-', $from);
        if (array_key_exists(1, $l) && array_key_exists(2, $l)) {

            if (strlen($l[1]) == 1) {
                $l[1] = '0' . $l[1];
            }
            if (strlen($l[2]) == 1) {
                $l[2] = '0' . $l[2];
            }
            $date = implode('-', $l);


            $date = CalendarUtils::createCarbonFromFormat('Y-m-d', $date);


            return $this->builder->where('created_at', '>=', new \DateTime($date));

        } else {
            return $this->builder;
        }

    }


    /**
     * Filter by $to.
     *
     * @param string $to
     * @return Builder
     */
    public function to($to)
    {

        $l = explode('-', $to);
        if (array_key_exists(1, $l) && array_key_exists(2, $l)) {

            if (strlen($l[1]) == 1) {
                $l[1] = '0' . $l[1];
            }
            if (strlen($l[2]) == 1) {
                $l[2] = '0' . $l[2];
            }
            $date = implode('-', $l);


            $date = CalendarUtils::createCarbonFromFormat('Y-m-d', $date);


            return $this->builder->where('created_at', '<=', new \DateTime($date));
        } else {
            return $this->builder;
        }
    }
}
