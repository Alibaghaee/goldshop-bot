<?php

namespace App\Http\Resources\GalleryItem;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryItem extends JsonResource
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
            'gallery_id'  => $this->gallery_id,
            'title'       => $this->title,
            'image'       => $this->image,
            'link'        => $this->link,
            'description' => $this->description,
            'order'       => $this->order,
            'active'      => $this->active,
            'edit_uri'    => $this->edit_uri,
            'delete_uri'  => $this->delete_uri,
        ];
    }
}
