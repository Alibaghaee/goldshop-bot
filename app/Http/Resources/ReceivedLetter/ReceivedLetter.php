<?php

namespace App\Http\Resources\ReceivedLetter;

use Illuminate\Http\Resources\Json\JsonResource;

class ReceivedLetter extends JsonResource
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
            'title'       => $this->title,
            'date'        => $this->date_fa,
            'description' => $this->description,
            'file'        => $this->file,
            'edit_uri'    => $this->edit_uri,
            'delete_uri'  => $this->delete_uri,
        ];
    }
}
