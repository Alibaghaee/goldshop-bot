<?php

namespace App\Traits;


trait HasModelEvents
{


    /**
     *Events by methods list.
     * @var array
     **/
    private static $modelEvents = [];


    /**
     *Call event method from parent trait.
     * @param  $model
     * @param string $methodName
     * @return void
     **/
    private static function callMethod($model, $methodName)
    {

        if (method_exists(self::class, $methodName)) {

            self::{$methodName}($model);
        } else {

            throw new \Exception("class HasModelEvents {$methodName} not found in registered event method of HasModelEvents trait");

        }


    }


    /**
     *Boot trait.
     *
     * @return void
     **/
    public static function bootHasModelEvents()
    {
        collect(self::$modelEvents)
            ->groupBy('type')
            ->each(function ($eventGroup, $eventType) {
                static::{$eventType}(function ($model) use ($eventGroup) {

                    $eventGroup
                        ->pluck('method')
                        ->each(function ($methodName) use ($model) {
                            self::callMethod($model, $methodName);
                        });
                });
            });
    }

    /**
     *Generate model event list.
     *
     * @param string $eventType
     * @param string $methodName
     * @return void
     **/
    public static function addModelEvent(string $eventType, string $methodName)
    {
        static::$modelEvents = array_merge(static::$modelEvents, [['type' => $eventType, 'method' => $methodName]]);
    }
    /*
     * alibaghaeiazad@gmail.com
     * */
}
