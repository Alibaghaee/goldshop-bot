<?php

namespace App\Http\Resources\Level;

use Illuminate\Http\Resources\Json\JsonResource;

class Level extends JsonResource
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
            'title'          => $this->title,
            'edit_uri'       => $this->edit_uri,
            'facilities_uri' => $this->facilities_uri,
            'delete_uri'     => $this->delete_uri,
            'creator_name'   => optional($this->admin)->fullname,
        ];
    }
}
