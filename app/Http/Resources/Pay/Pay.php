<?php

namespace App\Http\Resources\Pay;

use Illuminate\Http\Resources\Json\JsonResource;

class Pay extends JsonResource
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
            'id'               => $this->id,
            'domain_id'        => $this->domain_id,
            'title'            => $this->title,
            'description'      => $this->description,
            'price'            => $this->price,
            'payed'            => $this->payed,
            'payed_title'      => $this->payed_title,
            'transaction_id'   => $this->transaction_id,
            'refrence_id'      => $this->refrence_id,
            'tracking_code'    => $this->tracking_code,
            'card_number'      => $this->card_number,
            'payment_subject'  => $this->payment_subject,
            'mobile'           => $this->mobile,
            'emergency_mobile' => $this->emergency_mobile,
            'phone'            => $this->phone,
            'name'             => $this->name,
            'family'           => $this->family,
            'fullname'         => $this->fullname,
            'national_code'    => $this->national_code,
            'gender'           => $this->gender,
            'gender_title'     => $this->gender_title,
            'provice_id'       => $this->provice_id,
            'city_id'          => $this->city_id,
            'address'          => $this->address,
            'birth_date'       => $this->birth_date,
            'avatar'           => $this->avatar,
            'grade'            => $this->grade_title,
            'field_of_study'   => $this->field_of_study_title,
            'payment_subject'  => $this->payment_subject_title,
            'province_title'   => optional($this->province)->name,
            'city_title'       => optional($this->city)->name,
            'created_at_fa'    => $this->created_at_fa,
        ];
    }
}
