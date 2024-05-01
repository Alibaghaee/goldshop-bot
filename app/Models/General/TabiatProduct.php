<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Models\General\TabiatCode;
use App\Models\General\TabiatProductCategory;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Jenssegers\Mongodb\Eloquent\Model;

class TabiatProduct extends Model
{
    use Uri, View, Filterable;

    protected $connection = 'mongodb';

    protected $collection = 'tabiat_product';

    // protected $primaryKey = 'id';

    protected $route_name = 'tabiat_products';

    protected $guarded = [];

    public function getTabiatProductCategoryTitleAttribute()
    {
        return optional($this->tabiat_product_category)->title ?? '';
    }

    public function tabiat_product_category()
    {
        return $this->belongsTo(TabiatProductCategory::class, 'tabiat_product_category_id', 'id');
    }

    public static function scopeAsOption($query)
    {
        $aggregateBy = [
            [
                '$project' => [
                    '_id'  => 1,
                    'id'   => 1,
                    'name' => '$title',
                ]
            ],
            [
                '$sort' => ['_id' => -1]
            ]
        ];

        return $query->raw(function ($collection) use ($aggregateBy) {
            return $collection->aggregate($aggregateBy);
        });
    }

    public function tabiat_codes()
    {
        return $this->hasMany(TabiatCode::class);
    }

    public function getRouteParameters()
    {
        return [$this->getClassName() => $this->_id];
    }

    // {{dont_delete_this_comment}}
}
