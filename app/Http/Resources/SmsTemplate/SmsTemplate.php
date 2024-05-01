<?php

namespace App\Http\Resources\SmsTemplate;

use Illuminate\Http\Resources\Json\JsonResource;

class SmsTemplate extends JsonResource
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
            'title'         => $this->title,
            'tag'         => $this->tag,
            'description'         => $this->description,

            //
            'edit_uri'   => $this->edit_uri,
            'delete_uri' => $this->delete_uri,
        ];
    }
}
