<?php

namespace App\Http\Resources\SmsReceive;

use Illuminate\Http\Resources\Json\JsonResource;

class SmsReceive extends JsonResource
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
            'id'                            => $this->id,
            'note'                          => $this->note,
            'sender'                        => $this->sender,
            'receiver'                      => $this->receiver,
            'sms_id'                        => $this->sms_id,
            'status'                        => $this->status,
            'code_state'                    => $this->code_state,
            'ignored'                       => $this->ignored,
            'product_id'                    => $this->product_id,
            'tabiat_product_title'          => $this->tabiat_product_title,
            'product_catgory_id'            => $this->product_catgory_id,
            'tabiat_product_category_title' => $this->tabiat_product_category_title,
            'created_at_fa'                 => $this->created_at_fa,
            'edit_uri'                      => $this->edit_uri,
            'delete_uri'                    => $this->delete_uri,
        ];
    }
}
