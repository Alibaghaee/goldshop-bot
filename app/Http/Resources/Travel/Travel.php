<?php

namespace App\Http\Resources\Travel;

use App\Http\Resources\Driver\Driver;
use Illuminate\Http\Resources\Json\JsonResource;

class Travel extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id'         => $this->id,
            'beginning'         => $this->beginning,
            'beginning_time'         => $this->beginning_time_fa,
            'destination'         => $this->destination,
            'time_return'         => $this->time_return_fa,
            'reason'         => $this->reason,
            'status'         => $this->status,
            'status_fa'         => $this->status_fa,
            'user'         => $this->user,
            'user_id'         => $this->user_id,
            'driver_id'         => $this->driver_id,
            'driver'         => $this->whenLoaded('driver', function (){

                return new Driver($this->driver);
            }),
            'accompanying_person'         => $this->accompanying_person,
            'tracking_code'         => $this->tracking_code,
            'created_at_fa'         => $this->webservice_store_time_fa,



            //
            'edit_uri'   => $this->edit_uri,
            'delete_uri' => $this->delete_uri,
        ];
    }
}
