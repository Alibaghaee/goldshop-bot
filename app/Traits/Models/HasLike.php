<?php

namespace App\Traits\Models;

use App\Models\General\Like;

trait HasLike
{

    /**
     * Define a polymorphic one-to-one relationship to Like.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function like()
    {
        return $this->morphOne(Like::class, 'likeable');
    }




}
