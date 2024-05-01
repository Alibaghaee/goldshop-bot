<?php

namespace App\Http\Resources\ContactCategory;

use App\Http\Resources\PanelSms\PanelSms;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactCategory extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status,
            'statusFa' => $this->status_fa,
            'contactListUrl' => $this->contact_list_url,
            'contactsCount' => $this->contacts_count,
            'panelSmsId' => $this->panel_sms_id,
            'panelSms' => $this->whenLoaded('panelSms', function () {

                return new PanelSms($this->panelSms);
            }),
            //
            'edit_uri' => $this->edit_uri,
            'delete_uri' => $this->delete_uri,
        ];
    }
}
