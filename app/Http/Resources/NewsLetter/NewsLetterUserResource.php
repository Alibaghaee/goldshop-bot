<?php

namespace App\Http\Resources\NewsLetter;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsLetterUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'firstName' => $this->name,
            'lastName' => $this->family,
            'mobile' => $this->mobile,
            'subscripCode' => $this->subscrip_code,
            'address' => $this->address,
        ];
    }
}
