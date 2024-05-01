<?php

namespace App\Traits;

use App\Models\General\Map;

trait MapEvents
{


    public static function bootMapEvents()
    {
        self::addModelEvent('deleting', 'hasMapDeletingEvent');

    }

    /**
     *Declare 'deleting' Model Event.
     * @param Map $model
     * @return void
     **/
    public static function hasMapDeletingEvent($model)
    {
        if ($model->cloneLogs()->exists() && $model->forceDeleting) {

            $model->cloneLogs->each->delete();
        }
    }
}
