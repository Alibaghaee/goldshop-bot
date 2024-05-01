<?php

namespace App\Http\Resources\InvoiceBodyPortal;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceBodyPortal extends JsonResource
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
            'id'         => $this->id,
            'invoice_portal_id' => $this->invoice_portal_id,
            //
            'edit_uri'   => $this->edit_uri,
            'delete_uri' => $this->delete_uri,
        ];
    }
}
