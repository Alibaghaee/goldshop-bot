<?php

namespace App\Http\Resources\Field;

use Illuminate\Http\Resources\Json\JsonResource;

class Field extends JsonResource
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
            'id'            => $this->id,
            'name'          => $this->name,
            'type'          => $this->type,
            'type_title'    => $this->type_title,
            'label'         => $this->label,
            'category_id'   => $this->category_id,
            'default_value' => $this->default_value,
            'edit_uri'      => $this->edit_uri,
            'delete_uri'    => $this->delete_uri,
        ];
    }
}
