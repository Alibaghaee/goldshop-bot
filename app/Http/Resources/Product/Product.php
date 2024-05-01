<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            'category_item_id' => $this->category_item_id,
            'html_title'       => $this->html_title,
            'address_slug'     => $this->address_slug,
            'title'            => $this->title,
            'code'             => $this->code,
            'price'            => $this->price,
            'description'      => $this->description,
            'detail'           => $this->detail,
            'image'            => $this->image,
            'new'              => $this->new,
            'active'           => $this->active,
            'locale_id'        => $this->locale_id,
            'domain_id'        => $this->domain_id,
            'items_count'      => $this->items_count,
            'items_uri'        => $this->items_uri,
            'order_uri'        => $this->order_uri,
            'edit_uri'         => $this->edit_uri,
            'delete_uri'       => $this->delete_uri,
        ];
    }
}
