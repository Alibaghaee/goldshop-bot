<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Models\General\TabiatProduct;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Jenssegers\Mongodb\Eloquent\Model;

class TabiatProductCategory extends Model
{
    use Uri, View, Filterable;

    protected $connection = 'mongodb';

    protected $collection = 'tabiat_product_category';

    protected $route_name = 'tabiat_product_categories';

    protected $guarded = [];

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

    public function tabiat_products()
    {
        return $this->hasMany(TabiatProduct::class, 'id');
    }

    public function getRouteParameters()
    {
        return [$this->getClassName() => $this->_id];
    }

    // {{dont_delete_this_comment}}
}
