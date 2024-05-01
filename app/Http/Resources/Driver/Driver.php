<?php

namespace App\Http\Resources\Driver;

use App\Http\Resources\Travel\Travel;
use Illuminate\Http\Resources\Json\JsonResource;

class Driver extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->full_name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'organization_code' => $this->organization_code,
            'mobile' => $this->mobile,
            'status' => $this->status_fa,
            'address' => $this->address,
            'travels'         => $this->whenLoaded('travels', function (){

                return new Travel($this->travels);
            }),

            //
            'show_travels_uri' => $this->show_travels_uri,
            'edit_uri' => $this->edit_uri,
            'delete_uri' => $this->delete_uri,
        ];
    }
}
