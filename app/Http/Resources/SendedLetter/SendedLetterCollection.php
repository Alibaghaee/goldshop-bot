<?php

namespace App\Http\Resources\SendedLetter;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SendedLetterCollection extends ResourceCollection
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
