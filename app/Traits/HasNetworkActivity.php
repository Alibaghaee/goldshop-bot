<?php

namespace App\Traits;

use App\NetworkActivity;

trait HasNetworkActivity
{


    /**
     * Define a one-to-many relationship to NetworkActivity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function networkActivities()
    {
        return $this->hasMany(NetworkActivity::class);
    }

}
