<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class Admin extends JsonResource
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
            'name'       => $this->name,
            'email'      => $this->email,
            'mobile'     => $this->mobile,
            'username'   => $this->username,
            'edit_uri'   => $this->edit_uri,
            'delete_uri' => $this->delete_uri,
        ];
    }
}
