<?php

namespace App;

use App\Filters\Filterable;
use App\Models\General\AdminProfile;
use App\Models\General\Map;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class MapClone extends Model
{
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'region',
        'address',
        'location_x',
        'location_y',
        'color',
        'mesh',
        'banner',
        'cerline',
        'visitor',
        'visit_date',
        'installer',
        'install_date',
        'data',
        'image',
        'cerline_image',
        'promotional_available_item',
        'shop_available_products',
        'promotional_available_item_values',
        'map_id',
        'network_activity_id',
        'lat_long',
    ];

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
        return Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i:s');
    }

    /**
     * Define an inverse one-to-many relationship to Map.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function map()
    {
        return $this->belongsTo(Map::Class);
    }

    /**
     * Define an inverse one-to-many relationship to NetworkActivity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function networkActivity()
    {
        return $this->belongsTo(NetworkActivity::Class);
    }
}
