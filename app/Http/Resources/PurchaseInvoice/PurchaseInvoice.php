<?php

namespace App\Http\Resources\PurchaseInvoice;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseInvoice extends JsonResource
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
            'description' => $this->description,
            'image'       => $this->image,
            'created_at'  => $this->created_at_fa,
            'edit_uri'    => $this->edit_uri,
            'delete_uri'  => $this->delete_uri,
        ];
    }
}
