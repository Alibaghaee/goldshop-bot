<?php

namespace App\Http\Resources\SingleSmsSender;

use App\Http\Resources\ContactNumber\ContactNumber;
use App\Http\Resources\SenderNumber\SenderNumber;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class SingleSmsSender extends JsonResource
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
            'contactNumberId' => $this->contact_number_id,
            'contactNumber' => $this->whenLoaded('contactNumber', function () {

                return new ContactNumber($this->contactNumber);
            }),

            'senderNumberId' => $this->sender_number_id,
            'senderNumber' => $this->whenLoaded('senderNumber', function () {

                return new SenderNumber($this->senderNumber);
            }),

            'response' => $this->response,

            'createdAtFa' => $this->created_at_fa,
            //
            'edit_uri' => $this->edit_uri,
            'delete_uri' => $this->delete_uri,
        ];
    }
}
