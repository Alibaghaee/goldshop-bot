<?php

namespace App\Http\Resources\CategoryItem;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryItem extends JsonResource
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
            'category_id' => $this->category_id,
            'title'       => $this->title,
            'image'       => $this->image,
            'order'       => $this->order,
            'edit_uri'    => $this->edit_uri,
            'delete_uri'  => $this->delete_uri,
        ];
    }
}
