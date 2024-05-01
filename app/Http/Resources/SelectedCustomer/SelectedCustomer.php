<?php

namespace App\Http\Resources\SelectedCustomer;

use Illuminate\Http\Resources\Json\JsonResource;

class SelectedCustomer extends JsonResource
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
            'id'                                       => $this->id,
            'customer_fullname'                        => $this->customer_fullname,
            'customer_code'                            => $this->customer_code,
            'customer_phone'                           => $this->customer_phone,
            'shop_has_sign'                            => $this->shop_has_sign,
            'shop_address'                             => $this->shop_address,
            'shop_grade'                               => $this->shop_grade,
            'shop_salesman'                            => $this->shop_salesman,
            'shop_manager'                             => $this->shop_manager,
            'shop_region'                              => $this->shop_region,
            'shop_pakhor'                              => $this->shop_pakhor,
            'shop_ownership_status'                    => $this->shop_ownership_status,
            'shop_size'                                => $this->shop_size,
            'shop_shelf_size'                          => $this->shop_shelf_size,
            'shop_shelf_aarrangement_space_size'       => $this->shop_shelf_aarrangement_space_size,
            'shop_mesh_and_sticker_installation_space' => $this->shop_mesh_and_sticker_installation_space,
            'shop_purchase_status'                     => $this->shop_purchase_status,
            'sales_supervisor_comment'                 => $this->sales_supervisor_comment,
            'region_supervisor_comment'                => $this->region_supervisor_comment,
            'sales_manager_comment'                    => $this->sales_manager_comment,
            'image'                                    => $this->image,
            'created_at_fa'                            => $this->created_at_fa,
            'edit_uri'                                 => $this->edit_uri,
            'delete_uri'                               => $this->delete_uri,
        ];
    }
}
