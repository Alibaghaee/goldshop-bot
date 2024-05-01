<?php

namespace App\Http\Resources\ExpertAttendanceDays;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ExpertAttendanceDaysCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
