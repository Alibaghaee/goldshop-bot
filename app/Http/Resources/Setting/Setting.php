<?php

namespace App\Http\Resources\Setting;

use Illuminate\Http\Resources\Json\JsonResource;

class Setting extends JsonResource
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
            'value'       => $this->value,
            'removable'   => $this->removable,
            'type_title'  => $this->type_title,
            'edit_uri'    => $this->edit_uri,
            'delete_uri'  => $this->delete_uri,
            'locale_name' => $this->locale_name,
        ];
    }
}
