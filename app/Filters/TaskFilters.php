<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class TaskFilters extends QueryFilters
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
     * Filter by report_description.
     *
     * @param  string $report_description
     * @return Builder
     */
    public function report_description($report_description)
    {
        return $this->builder->where('report_description', 'like', '%' . $report_description . '%');
    }

    /**
     * Filter by creator_admin.
     *
     * @param  string $creator_admin
     * @return Builder
     */
    public function creator_admin($creator_admin)
    {
        $creator_admin = json_decode($creator_admin);
        return $this->builder->where('creator_admin_id', $creator_admin->id);
    }

    /**
     * Filter by assigned_to_admin.
     *
     * @param  string $assigned_to_admin
     * @return Builder
     */
    public function assigned_to_admin($assigned_to_admin)
    {
        $assigned_to_admin = json_decode($assigned_to_admin);
        return $this->builder->where('assigned_to_admin_id', $assigned_to_admin->id);
    }

    /**
     * Filter by status.
     *
     * @param  string $status
     * @return Builder
     */
    public function status($status)
    {
        $status = json_decode($status);
        return $this->builder->where('status', $status->id);
    }

    /**
     * Filter by report_status.
     *
     * @param  string $report_status
     * @return Builder
     */
    public function report_status($report_status)
    {
        $report_status = json_decode($report_status);
        if ($report_status->id == 1) { // not sended
            return $this->builder->where('deadline', '<', now())->where('reported_at', null);
        }
        if ($report_status->id == 2) { // dealy
            return $this->builder->whereColumn('reported_at', '>', 'deadline')->where('reported_at', '!=',null);
        }
        if ($report_status->id == 3) { // ontime
            return $this->builder->whereColumn('reported_at', '<=', 'deadline')->where('reported_at', '!=',null);
        }
    }

    /**
     * Filter by start_date min.
     *
     * @param  string $start_date
     * @return Builder
     */
    public function start_date_min($start_date)
    {
        return $this->builder->whereDate('start_date', '>=', $start_date);
    }

    /**
     * Filter by start_date max.
     *
     * @param  string $start_date
     * @return Builder
     */
    public function start_date_max($start_date)
    {
        return $this->builder->whereDate('start_date', '<=', $start_date);
    }

    /**
     * Filter by deadline min.
     *
     * @param  string $deadline
     * @return Builder
     */
    public function deadline_min($deadline)
    {
        return $this->builder->whereDate('deadline', '>=', $deadline);
    }

    /**
     * Filter by deadline max.
     *
     * @param  string $deadline
     * @return Builder
     */
    public function deadline_max($deadline)
    {
        return $this->builder->whereDate('deadline', '<=', $deadline);
    }

    /**
     * Filter by reported_at min.
     *
     * @param  string $reported_at
     * @return Builder
     */
    public function reported_at_min($reported_at)
    {
        return $this->builder->whereDate('reported_at', '>=', $reported_at);
    }

    /**
     * Filter by reported_at max.
     *
     * @param  string $reported_at
     * @return Builder
     */
    public function reported_at_max($reported_at)
    {
        return $this->builder->whereDate('reported_at', '<=', $reported_at);
    }


}
