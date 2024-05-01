<?php

namespace App\Http\Resources\TabiatCode;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TabiatCodeCollection extends ResourceCollection
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
