<?php

namespace App\Http\Resources\SelectedCustomer;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SelectedCustomerCollection extends ResourceCollection
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
