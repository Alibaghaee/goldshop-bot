<?php

namespace App\Http\Resources\SendedLetter;

use Illuminate\Http\Resources\Json\JsonResource;

class SendedLetter extends JsonResource
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
            'id'               => $this->id,
            'admin_id'         => $this->admin_id,
            'creator_fullname' => optional($this->admin)->fullname,
            'title'            => $this->title,
            'date'             => $this->date_fa,
            'description'      => $this->description,
            'file'             => $this->file,
            'export_url'       => $this->export_url,
            'edit_uri'         => $this->edit_uri,
            'delete_uri'       => $this->delete_uri,
        ];
    }
}
