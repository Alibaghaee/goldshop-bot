<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\UriForItems;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    use UriForItems, View, Filterable;

    protected $route_name = 'galleries.gallery_items';

    protected $guarded = [];

    public function gallery()
    {
        return $this->belongsTo('App\Models\General\Gallery');
    }

    public function scopeIsActive($query)
    {
        return $query->where('active', true);
    }
}
