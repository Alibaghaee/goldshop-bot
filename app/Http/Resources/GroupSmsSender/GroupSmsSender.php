<?php

namespace App\Http\Resources\GroupSmsSender;

use App\Http\Resources\ContactCategory\ContactCategory;
use App\Http\Resources\SenderNumber\SenderNumber;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class GroupSmsSender extends JsonResource
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

            'description' => $this->description,
            'shortDescription' => Str::limit($this->description, 20, '...'),
            'status' => $this->status,
            'statusFa' => $this->status_fa,
            'type' => $this->type,
            'typeFa' => $this->type_fa,
            'contactCategoryId' => $this->contact_category_id,
            'contactCategory' => $this->whenLoaded('contactCategory', function () {

                return new ContactCategory($this->contactCategory);
            }),

            'senderNumberId' => $this->sender_number_id,
            'senderNumber' => $this->whenLoaded('senderNumber', function () {

                return new SenderNumber($this->senderNumber);
            }),
            'createdAtFa' => $this->created_at_fa,

            //
            'edit_uri' => $this->edit_uri,
            'delete_uri' => $this->delete_uri,
        ];
    }
}
