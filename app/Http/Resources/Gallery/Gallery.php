<?php

namespace App\Http\Resources\Gallery;

use Illuminate\Http\Resources\Json\JsonResource;

class Gallery extends JsonResource
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
            'id'                 => $this->id,
            'title'              => $this->title,
            'category_item_id'   => $this->category_item_id,
            'image'              => $this->image,
            'description'        => $this->description,
            'locale_id'          => $this->locale_id,
            'order'              => $this->order,
            'active'             => $this->active,
            'items_count'        => $this->items_count,
            'items_uri'          => $this->items_uri,
            'order_uri'          => $this->order_uri,
            'edit_uri'           => $this->edit_uri,
            'delete_uri'         => $this->delete_uri,
            'category_item_name' => optional($this->category_item)->title,
            'locale_name'        => $this->locale_name,
            'url'                => $this->url,
        ];
    }
}
