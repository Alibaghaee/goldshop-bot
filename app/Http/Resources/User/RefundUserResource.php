<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Payment\SimplePaymentCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class RefundUserResource extends JsonResource
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
            'name'                 => $this->name,
            'family'               => $this->family,
            'mobile'               => mask_number($this->mobile),
            'emergency_mobile'     => mask_number($this->emergency_mobile),
            'national_code'        => $this->national_code,
            'gender_title'         => $this->gender_title,
            'field_title'          => $this->field_title,
            'province_title'       => optional($this->province)->name,
            'city_title'           => optional($this->city)->name,
            'total_payments_price' => $this->total_payments_price,
            'payments'             => new SimplePaymentCollection($this->successful_payments),
        ];
    }
}
