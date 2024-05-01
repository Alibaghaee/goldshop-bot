<?php

namespace App\Http\Resources\DiscountItem;

use Illuminate\Http\Resources\Json\JsonResource;

class DiscountItem extends JsonResource
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
            'discount_id'      => $this->discount_id,
            'code'             => $this->code,
            'discount_amount'  => $this->discount_amount,
            'is_percent'       => $this->is_percent,
            'max_uses'         => $this->max_uses,
            'uses'             => $this->uses,
            'starts_at'        => $this->starts_at_fa,
            'expires_at'       => $this->expires_at_fa,
            'is_over_max_uses' => $this->is_over_max_uses,
            'edit_uri'         => $this->edit_uri,
            'delete_uri'       => $this->delete_uri,
        ];
    }
}
