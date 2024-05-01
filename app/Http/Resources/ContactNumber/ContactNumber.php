<?php

namespace App\Http\Resources\ContactNumber;

use App\Http\Resources\ContactCategory\ContactCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactNumber extends JsonResource
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
            'name' => $this->name,
            'en_name' => $this->en_name,
            'mobile' => $this->mobile,
            'status' => $this->status,
            'statusFa' => $this->status_fa,
            'gender' => $this->gender,
            'genderFa' => $this->genderFa,
            'contactCategory' => $this->whenLoaded('contactCategory', function () {

                return new ContactCategory($this->contactCategory);
            }),
            //
            'edit_uri' => $this->edit_uri,
            'delete_uri' => $this->delete_uri,
        ];
    }
}
