<?php

namespace App\Traits\Models;


use Illuminate\Database\Eloquent\Builder;

trait HasPublishedScope
{


    public function scopePublished(Builder $query)
    {
        return $query->where('status', 'published');
    }

}
