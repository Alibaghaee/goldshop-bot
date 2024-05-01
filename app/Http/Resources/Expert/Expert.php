<?php

namespace App\Http\Resources\Expert;

use Illuminate\Http\Resources\Json\JsonResource;

class Expert extends JsonResource
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
            'name'                => $this->name,
            'family'              => $this->family,
            'mobile'              => $this->mobile,
            'phone'               => $this->phone,
            'address'             => $this->address,
            'visit_duration'      => $this->visit_duration,
            'visit_fee'           => $this->visit_fee,
            'expert_contribution' => $this->expert_contribution,
            'description'         => $this->description,
            'department_id'       => $this->department_id,
            'department_name'     => $this->department_name,
            'edit_uri'            => $this->edit_uri,
            'delete_uri'          => $this->delete_uri,
        ];
    }
}
