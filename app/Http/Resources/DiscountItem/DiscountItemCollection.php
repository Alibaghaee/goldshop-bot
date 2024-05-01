<?php

namespace App\Http\Resources\DiscountItem;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DiscountItemCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
