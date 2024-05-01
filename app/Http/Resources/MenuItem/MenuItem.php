<?php

namespace App\Http\Resources\MenuItem;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuItem extends JsonResource
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
            'menu_id'     => $this->menu_id,
            'title'       => $this->title,
            'image'       => $this->image,
            'link'        => $this->link,
            'description' => $this->description,
            'svg'         => $this->svg,
            'active'      => $this->active,
            'order'       => $this->order,
            'edit_uri'    => $this->edit_uri,
            'delete_uri'  => $this->delete_uri,
        ];
    }
}
