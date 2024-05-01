<?php

namespace App\Http\Resources\PurchaseDetail;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseDetail extends JsonResource
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
            'purchase_id' => $this->purchase_id,
            'product_id'  => $this->product_id,
            'title'       => $this->title,
            'code'        => $this->code,
            'price'       => $this->price,
            'description' => $this->description,
            'detail'      => $this->detail,
            'image'       => $this->image,
            'count'       => $this->count,
        ];
    }
}
