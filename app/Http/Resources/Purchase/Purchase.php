<?php

namespace App\Http\Resources\Purchase;

use App\Http\Resources\PurchaseDetail\PurchaseDetailCollection;
use App\Http\Resources\User\User;
use Illuminate\Http\Resources\Json\JsonResource;

class Purchase extends JsonResource
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
            'id'             => $this->id,
            'package_title'  => $this->package_title,
            'title'          => $this->title,
            'user_id'        => $this->user_id,
            'price'          => $this->price,
            'payed'          => $this->payed,
            'payed_title'    => $this->payed_title,
            'user_fullname'  => optional($this->user)->fullname,
            'transaction_id' => $this->transaction_id,
            'refrence_id'    => $this->refrence_id,
            'tracking_code'  => $this->tracking_code,
            'card_number'    => $this->card_number,
            'user'           => new User($this->user),
            'created_at_fa'  => $this->created_at_fa,
            'description'    => $this->description,
            'details'        => new PurchaseDetailCollection($this->details),
            'edit_uri'       => $this->edit_uri,
        ];
    }
}
