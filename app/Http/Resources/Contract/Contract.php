<?php

namespace App\Http\Resources\Contract;

use Illuminate\Http\Resources\Json\JsonResource;

class Contract extends JsonResource
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
            'id'                => $this->id,
            'customer_fullname' => optional($this->customer)->fullname,
            'title'             => $this->title,
            'description'       => $this->description,
            'body'              => $this->body,
            'file'              => $this->file,
            'is_pattern'        => $this->is_pattern,
            'export_url'        => $this->export_url,
            'edit_uri'          => $this->edit_uri,
            'delete_uri'        => $this->delete_uri,
        ];
    }
}
