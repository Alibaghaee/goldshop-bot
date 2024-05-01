<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class ContactCategoryFilters extends QueryFilters
{
    use GlobalFilters;

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
     * Filter by panelSms.
     *
     * @param string $panelSms
     * @return Builder
     */
    public function panelSms($panelSms)
    {
        if (isset(json_decode($panelSms)->id)) {

            return $this->builder->where('panel_sms_id', json_decode($panelSms)->id);
        }
        return $this->builder;
    }

    /**
     * Filter by mobile.
     *
     * @param string $mobile
     * @return Builder
     */
    public function mobile($mobile)
    {
        return $this->builder->whereHas('contactNumbers', function (Builder $query) use ($mobile) {

            $query->where('mobile', 'like', '%' . $mobile . '%');
        });
    }

    /**
     * Filter by panel_sms_id.
     *
     * @param string $panel_sms_id
     * @return Builder
     */
    public function panel_sms_id($panel_sms_id)
    {
        return $this->builder->whereHas('panelSms', function (Builder $query) use ($panel_sms_id) {

            $query->where('panel_sms_id', 'like', '%' . $panel_sms_id . '%');
        });
    }


}
