<?php

namespace App\Http\Resources\PanelSms;

use App\Http\Resources\SenderNumber\SenderNumberCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class PanelSms extends JsonResource
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
            'username' => $this->username,
            'domain' => $this->domain,
            'domainAlias' => $this->domain_alias,
            'status' => $this->status,
            'statusFa' => $this->status_fa,
            'type' => $this->type,
            'typeFa' => $this->type_fa,
            'senderNumbersCount' => $this->sender_numbers_count,

            'senderNumbers' => $this->whenLoaded('senderNumbers', function () {


                return new SenderNumberCollection($this->senderNumbers);
            }),

            //
            'edit_uri' => $this->edit_uri,
            'delete_uri' => $this->delete_uri,
        ];
    }
}
