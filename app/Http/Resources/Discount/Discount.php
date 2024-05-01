<?php

namespace App\Http\Resources\Discount;

use Illuminate\Http\Resources\Json\JsonResource;

class Discount extends JsonResource
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
            'id'              => $this->id,
            'title'           => $this->title,
            'discount_amount' => $this->discount_amount,
            'is_percent'      => $this->is_percent,
            'count'           => $this->count,
            'max_uses'        => $this->max_uses,
            'starts_at'       => $this->starts_at_fa,
            'expires_at'      => $this->expires_at_fa,
            'items_count'     => $this->items_count,
            'items_uri'       => $this->items_uri,
            'edit_uri'        => $this->edit_uri,
            'delete_uri'      => $this->delete_uri,
        ];
    }
}
