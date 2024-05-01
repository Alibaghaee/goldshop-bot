<?php

namespace App\Http\Resources\SenderNumber;

use App\Http\Resources\PanelSms\PanelSms;
use Illuminate\Http\Resources\Json\JsonResource;

class SenderNumber extends JsonResource
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
            'number' => $this->number,
            'status' => $this->status,
            'statusFa' => $this->status_fa,
            'type' => $this->type,
            'typeFa' => $this->type_fa,
            'dargah' => $this->dargah,
            'dargahFa' => $this->dargahFa,
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
