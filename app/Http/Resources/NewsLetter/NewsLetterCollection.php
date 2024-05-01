<?php

namespace App\Http\Resources\NewsLetter;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NewsLetterCollection extends ResourceCollection
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
