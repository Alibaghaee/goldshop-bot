<?php

namespace App\Http\Resources\SmsSend;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SmsSendCollection extends ResourceCollection
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
