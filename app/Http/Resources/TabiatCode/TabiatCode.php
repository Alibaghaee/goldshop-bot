<?php

namespace App\Http\Resources\TabiatCode;

use Illuminate\Http\Resources\Json\JsonResource;

class TabiatCode extends JsonResource
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
            'id'                   => $this->id,
            'code'                 => $this->code,
            'refrence_id'          => $this->refrence_id,
            'tabiat_product_id'    => $this->tabiat_product_id,
            'tabiat_product_title' => $this->tabiat_product_title,
            'status'               => $this->status,
            'profile_id'           => $this->member_id,
            'utilization_date'     => $this->utilization_date_fa,
            'created_at'           => $this->created_at_fa,
            'edit_uri'             => $this->edit_uri,
            'delete_uri'           => $this->delete_uri,
        ];
    }
}
