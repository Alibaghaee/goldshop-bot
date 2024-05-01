<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class Customer extends JsonResource
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
            'id'                    => $this->id,
            'type'                  => $this->type_title,
            'group'                 => optional($this->group)->title,
            'address'               => $this->address,
            'postal_code'           => $this->postal_code,
            'email'                 => $this->email,
            'phone'                 => $this->phone,
            'fax'                   => $this->fax,
            'website'               => $this->website,
            'how_know_id'           => $this->how_know_id,
            'company_name'          => $this->company_name,
            'economic_code'         => $this->economic_code,
            'company_national_code' => $this->company_national_code,
            'register_id'           => $this->register_id,
            'name'                  => $this->name,
            'family'                => $this->family,
            'fullname'              => $this->fullname,
            'mobile'                => $this->mobile,
            'father_name'           => $this->father_name,
            'national_code'         => $this->national_code,
            'id_number'             => $this->id_number,
            'place'                 => $this->place,
            'sex'                   => $this->sex_title,
            'birth_date'            => $this->birth_date_fa,
            'created_at'            => $this->created_at_fa,
            'admin_fullname'        => optional($this->admin)->fullname,
            'edit_uri'              => $this->edit_uri,
            'delete_uri'            => $this->delete_uri,
        ];
    }
}
