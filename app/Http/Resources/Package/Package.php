<?php

namespace App\Http\Resources\Package;

use Illuminate\Http\Resources\Json\JsonResource;

class Package extends JsonResource
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
            'id'                   => $this->id,
            'title'                => $this->title,
            'info'                 => $this->info,
            'first_description'    => $this->first_description,
            'second_description'   => $this->second_description,
            'agreement_text'       => $this->agreement_text,
            'price'                => $this->price,
            'allow_installment'    => $this->allow_installment,
            'pre_payment'          => $this->pre_payment,
            'image'                => $this->image,
            'full_payment_message' => $this->full_payment_message,
            'pre_payment_message'  => $this->pre_payment_message,
            'edit_uri'             => $this->edit_uri,
            'delete_uri'           => $this->delete_uri,
        ];
    }
}
