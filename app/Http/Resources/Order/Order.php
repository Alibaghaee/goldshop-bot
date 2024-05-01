<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
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
            'id'                  => $this->id,
            'request_info'        => $this->request_info,
            'product_type'        => $this->product_type,
            'packing_type'        => $this->packing_type,
            'weight'              => $this->weight,
            'volume'              => $this->volume,
            'origin'              => $this->origin,
            'destination'         => $this->destination,
            'preparation_time'    => $this->preparation_time,
            'transportation_type' => $this->transportation_type,
            'fullname'            => $this->fullname,
            'mobile'              => $this->mobile,
            'edit_uri'            => $this->edit_uri,
            'delete_uri'          => $this->delete_uri,
        ];
    }
}
