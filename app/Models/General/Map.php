<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\MapClone;
use App\Traits\HasLocation;
use App\Traits\HasModelEvents;
use App\Traits\MapEvents;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Map extends Model
{
    use Uri, View, Filterable, MapEvents,HasLocation;
    use SoftDeletes;

    /**
     *Important use end  line.
     **/
    use HasModelEvents;

    protected $route_name = 'maps';

    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'promotional_available_item' => 'array',
        'shop_available_products' => 'array',
        'promotional_available_item_values' => 'array',
    ];



    public function getCreatedAtFaAttribute()
    {
        return $this->created_at ? Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i:s') : '';
    }

    public function getInstallDateFaAttribute()
    {
        return $this->install_date ? Jalalian::fromDateTime($this->install_date)->format('Y/m/d H:i:s') : '';
    }

    public function getVisitDateFaAttribute()
    {
        return $this->visit_date ? Jalalian::fromDateTime($this->visit_date)->format('Y/m/d H:i:s') : '';
    }


    public function getMapUriAttribute()
    {

        return 'https://map.ir/lat/'
            . explode(',', $this->lat_long ?? '')[0]
            . '/lng/'
            . explode(',', $this->lat_long ?? '')[1]
            . '/z/17/p/' . $this->code;
    }

    public function getNeshanMapUriAttribute()
    {
        return 'https://neshan.org/maps/@'
            . explode(',', $this->lat_long ?? '')[0]
            . ','
            . explode(',', $this->lat_long ?? '')[1]
            . ',15.0z,1.0p/routing/car/destination/'
            . explode(',', $this->lat_long ?? '')[0]
            . ',' . explode(',', $this->lat_long ?? '')[1];
    }

    public function getIsSoftDeleteAttribute()
    {
        return $this->deleted_at === null ? false : true;
    }


    public function showCloneUri($id)
    {

        if ($this->cloneLogs->where('network_activity_id', $id)->first()) {
            return route('maps.showClone',
                optional($this->cloneLogs
                    ->where('network_activity_id', $id)
                    ->first())->id);
        } else {

            return null;
        }

    }

    /**
     *Create cloneMap
     * @return void
     **/
    public function createCloneLog($activityId): void
    {


        $this->cloneLogs()->create([
            'code' => $this->code,
            'region' => $this->region,
            'address' => $this->address,
            'location_x' => $this->location_x,
            'location_y' => $this->location_y,
            'color' => $this->color,
            'mesh' => $this->mesh,
            'banner' => $this->banner,
            'cerline' => $this->cerline,
            'visitor' => $this->visitor,
            'visit_date' => $this->visit_date,
            'installer' => $this->installer,
            'install_date' => $this->install_date,
            'data' => $this->data,
            'image' => $this->image,
            'cerline_image' => $this->cerline_image,
            'promotional_available_item' => $this->promotional_available_item,
            'shop_available_products' => $this->shop_available_products,
            'promotional_available_item_values' => $this->promotional_available_item_values,
            'lat_long' => $this->lat_long,
            'network_activity_id' => $activityId,
        ]);
    }

    /**
     * Define a one-to-many relationship to MapClone.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cloneLogs()
    {

        return $this->hasMany(MapClone::class);
    }

    // {{dont_delete_this_comment}}
}
