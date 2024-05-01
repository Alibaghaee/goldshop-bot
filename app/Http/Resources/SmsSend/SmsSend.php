<?php

namespace App\Http\Resources\SmsSend;

use Illuminate\Http\Resources\Json\JsonResource;

class SmsSend extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'member_id'     => $this->member_id,
            'mobile'        => $this->mobile,
            'note'          => $this->note,
            'sender'        => $this->sender,
            'status'        => $this->status,
            'created_at_fa' => $this->created_at_fa,
            'edit_uri'      => $this->edit_uri,
            'delete_uri'    => $this->delete_uri,
        ];
    }
}
