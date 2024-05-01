<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use Illuminate\Database\Eloquent\Builder;

class MapFilters extends QueryFilters
{
    use GlobalFilters;

    /**
     * Filter by code.
     *
     * @param string $code
     * @return Builder
     */
    public function code($code)
    {
        return $this->builder->where('code', 'like', '%' . $code . '%');
    }

    /**
     * Filter by region.
     *
     * @param string $region
     * @return Builder
     */
    public function region($region)
    {
        return $this->builder->where('region', 'like', '%' . $region . '%');
    }

    /**
     * Filter by location.
     *
     * @param string $location
     * @return Builder
     */
    public function location($location)
    {

        return $this->builder->where(function (Builder $query) use ($location) {

            $query->where('location_x', 'like', '%' . explode(',', $location)[0]??'' . '%');
            $query->where('location_y', 'like', '%' . explode(',', $location)[1]??'' . '%');
            $query->orWhereHas('location', function (Builder $query) use ($location) {
                $query->where('lat_long', 'like', '%' . $location . '%');
            });
        });
    }

    /**
     * Filter by address.
     *
     * @param string $address
     * @return Builder
     */
    public function address($address)
    {
        return $this->builder->where('address', 'like', '%' . $address . '%');
    }

    /**
     * Filter by color.
     *
     * @param string $color
     * @return Builder
     */
    public function color($color)
    {
        return $this->builder->where('color', 'like', '%' . $color . '%');
    }

    /**
     * Filter by visitor.
     *
     * @param string $visitor
     * @return Builder
     */
    public function visitor($visitor)
    {
        return $this->builder->where('visitor', 'like', '%' . $visitor . '%');
    }

    /**
     * Filter by installer.
     *
     * @param string $installer
     * @return Builder
     */
    public function installer($installer)
    {
        return $this->builder->where('installer', 'like', '%' . $installer . '%');
    }

    /**
     * Filter by mesh.
     *
     * @param string $mesh
     * @return Builder
     */
    public function mesh($mesh)
    {
        $mesh = ($mesh == 'true') ? true : false;
        return $this->builder->where('mesh', $mesh);
    }

    /**
     * Filter by banner.
     *
     * @param string $banner
     * @return Builder
     */
    public function banner($banner)
    {
        $banner = ($banner == 'true') ? true : false;
        return $this->builder->where('banner', $banner);
    }

    /**
     * Filter by cerline.
     *
     * @param string $cerline
     * @return Builder
     */
    public function cerline($cerline)
    {
        $cerline = ($cerline == 'true') ? true : false;
        return $this->builder->where('cerline', $cerline);
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

    /**
     * Filter by visit_date min.
     *
     * @param string $visit_date
     * @return Builder
     */
    public function visit_date_min($visit_date)
    {
        return $this->builder->where('visit_date', '>=', new \DateTime($visit_date));
    }

    /**
     * Filter by visit_date max.
     *
     * @param string $visit_date
     * @return Builder
     */
    public function visit_date_max($visit_date)
    {
        return $this->builder->where('visit_date', '<=', new \DateTime($visit_date));
    }

    /**
     * Filter by install_date min.
     *
     * @param string $install_date
     * @return Builder
     */
    public function install_date_min($install_date)
    {
        return $this->builder->where('install_date', '>=', new \DateTime($install_date));
    }

    /**
     * Filter by install_date max.
     *
     * @param string $install_date
     * @return Builder
     */
    public function install_date_max($install_date)
    {
        return $this->builder->where('install_date', '<=', new \DateTime($install_date));
    }

    /**
     * Filter by deleted_at.
     *
     * @param  $deleted_at
     * @return Builder
     */
    public function deleted_at($deleted_at)
    {

        if (filter_var($deleted_at, FILTER_VALIDATE_BOOLEAN)) {

            return $this->builder->onlyTrashed();
        } else {
            return $this->builder->whereNull('deleted_at');
        }
    }
}
