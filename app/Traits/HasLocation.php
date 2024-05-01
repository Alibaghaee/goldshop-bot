<?php

namespace App\Traits;

use App\Location;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasLocation
{


    /**
     *Initialize.
     *
     * @return void
     **/
    public function initializeHasLocation()
    {
        $this->append(
            'lat_long'
        );
    }

    /**
     *Boot trait.
     *
     * @return void
     **/
    public static function bootHasLocation()
    {
        self::addModelEvent('created', 'hasLocationCreatedEvent');
        self::addModelEvent('updated', 'hasLocationUpdatedEvent');
        self::addModelEvent('deleting', 'hasLocationDeletingEvent');
    }


    /**
     *Declare 'created' Model Event.
     *
     * @return void
     **/
    public static function hasLocationCreatedEvent($model)
    {
        $request = \request();

        if ($request->has('location') && $request->filled('location')) {

            $model->location()
                ->create(['lat_long' => $request->input('location')]);
        }
    }

    /**
     *Declare 'updated' Model Event.
     *
     * @return void
     **/
    public static function hasLocationUpdatedEvent($model)
    {
        $request = \request();

        if ($request->has('location') && $request->filled('location')) {
            /**
             *Mute Model event.
             **/
            $model->unsetEventDispatcher();

            if ($model->location()->exists()) {


                $model->location->update(['lat_long' => $request->input('location')]);

            } else {

                $model->location()
                    ->create(['lat_long' => $request->input('location')]);
            }


        }
    }


    /**
     *Declare 'deleting' Model Event.
     *
     * @return void
     **/
    public static function hasLocationDeletingEvent($model)
    {
        if ($model->location()->exists() && $model->forceDeleting) {

            optional($model->location)->delete();
        }
    }

    /**
     * Define a polymorphic one-to-one relationship to Location.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function location(): MorphOne
    {
        return $this->morphOne(Location::class, 'locationable');
    }


    /**
     *GET lat_long.
     *
     * @return string|null
     **/
    public function getLatLongAttribute()
    {
        if ($this->location()->exists()) {

            return optional($this->location)->lat_long;
        } else {
            try {

                return $this->location_x . ',' . $this->location_y;
            } catch (\Exception $e) {

                return null;
            }
        }
    }

    /**
     *GET link.
     *
     * @return string|null
     **/
    public function getLinkAttribute()
    {

        return is_null($this->lat_long) ? null : 'http://maps.google.com/maps?q=loc:' . $this->lat_long;
    }
}
