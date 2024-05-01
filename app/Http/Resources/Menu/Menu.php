<?php

namespace App\Http\Resources\Menu;

use Illuminate\Http\Resources\Json\JsonResource;

class Menu extends JsonResource
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
            'link'        => $this->link,
            'description' => $this->description,
            'image'       => $this->image,
            'depth'       => $this->depth,
            'menu_type'   => $this->menu_type,
            'locale_name' => $this->locale_name,
            'domain_id'   => $this->domain_id,
            'removable'   => $this->removable,
            'items_count' => $this->items_count,
            'items_uri'   => $this->items_uri,
            'order_uri'   => $this->order_uri,
            'edit_uri'    => $this->edit_uri,
            'delete_uri'  => $this->delete_uri,
        ];
    }
}
