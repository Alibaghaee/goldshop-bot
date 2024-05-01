<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class User extends JsonResource
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
            'subscrip_code'                            => $this->subscrip_code,
            'name'                          => $this->name,
            'family'                        => $this->family,
            'email'                         => $this->email,
            'mobile'                        => $this->mobile,
            'second_mobile'                        => $this->second_mobile,
            'username'                      => $this->username,
            'address'                       => $this->address,
            'phone'                         => $this->phone,
            'avatar'                        => $this->avatar,
            'emergency_mobile'              => $this->emergency_mobile,
            'national_code'                 => $this->national_code,
            'gender_title'                  => $this->gender_title,
            'field_title'                   => $this->field_title,
            'province_title'                => optional($this->province)->name,
            'city_title'                    => optional($this->city)->name,
            'created_at_fa'                 => $this->created_at_fa,
            'updated_at_fa'                 => $this->updated_at_fa,
            'total_purchases_price'         => $this->total_purchases_price,
            'last_successful_tracking_code' => $this->last_successful_tracking_code,
            'payments'                      => $this->successful_payments,
            'purchases'                     => $this->successful_purchases,
            'edit_uri'                      => $this->edit_uri,
            'delete_uri'                    => $this->delete_uri,
            'payments_list_uri'             => $this->payments_list_uri,
            'purchases_list_uri'            => $this->purchases_list_uri,
            'iban'                          => $this->iban,
            'refunds'                       => $this->refunds,
            'refunds_count'                 => $this->refunds_count,
            'refund_status_title'           => $this->refunds_count ? 'بازگشت هزینه داده شده' : 'بدون بازگشت هزینه',
            'account_owner'                 => Arr::get($this->iban_meta, 'account_owner'),
            'family_relationship'           => Arr::get($this->iban_meta, 'family_relationship'),
            'bank_name'                     => Arr::get($this->iban_meta, 'bank_name'),
            'grade'                         => $this->grade_title,
            'field_of_study'                => $this->field_of_study_title,
            'postal_code'                   => $this->postal_code,
            'wallet'                        => $this->wallet,
        ];
    }
}
