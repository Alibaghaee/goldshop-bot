<?php

namespace App\Http\Resources\Member;

use Illuminate\Http\Resources\Json\JsonResource;

class Member extends JsonResource
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
            'id'             => $this->id,
            'name'           => $this->name,
            'family'         => $this->family,
            'mobile'         => $this->mobile,
            'birth_date'     => $this->birth_date,
            'province_title' => '',
            'city_title'     => '',
            // 'province_title' => $this->province_title,
            // 'city_title'     => $this->city_title,
            'complete'       => $this->complete,
            'blacklist'      => $this->blacklist,
            'created_at_fa'  => $this->created_at_fa,
            'updated_at_fa'  => $this->updated_at_fa,
            'birth_date_fa'  => $this->birth_date_fa,
            'edit_uri'       => $this->edit_uri,
            'delete_uri'     => $this->delete_uri,
        ];
    }
}
