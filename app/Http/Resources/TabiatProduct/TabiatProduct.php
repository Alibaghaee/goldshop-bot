<?php

namespace App\Http\Resources\TabiatProduct;

use Illuminate\Http\Resources\Json\JsonResource;

class TabiatProduct extends JsonResource
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
            '_id'                           => $this->_id,
            'id'                            => $this->id,
            'tabiat_product_category_id'    => $this->tabiat_product_category_id,
            'tabiat_product_category_title' => $this->tabiat_product_category_title,
            'title'                         => $this->title,
            'description'                   => $this->description,
            'edit_uri'                      => $this->edit_uri,
            'delete_uri'                    => $this->delete_uri,
        ];
    }
}
