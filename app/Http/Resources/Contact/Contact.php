<?php

namespace App\Http\Resources\Contact;

use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
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
            'id'          => $this->id,
            'fullname'    => $this->fullname,
            'mobile'      => $this->mobile,
            'phone'       => $this->phone,
            'email'       => $this->email,
            'description' => $this->description,
            'ip'          => $this->ip,
            'edit_uri'    => '',
            'delete_uri'  => $this->delete_uri,
        ];
    }
}
