<?php

namespace App\Http\Resources\SmsReceive;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SmsReceiveCollection extends ResourceCollection
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
