<?php

namespace App\Http\Resources\ProductItem;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductItem extends JsonResource
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
            'product_id'       => $this->product_id,
            'file'             => $this->file,
            'title'            => $this->title,
            'description'      => $this->description,
            'type'             => $this->type,
            'type_title'       => $this->type_title,
            'active'           => $this->active,
            'parent_item_id'   => $this->parent_item_id,
            'category_item_id' => $this->category_item_id,
            'order'            => $this->order,
            'track_count'      => $this->track_count,
            'edit_uri'         => $this->edit_uri,
            'delete_uri'       => $this->delete_uri,
        ];
    }
}
