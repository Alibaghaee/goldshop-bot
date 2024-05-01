<?php

namespace App\Http\Resources\Notify;

use Illuminate\Http\Resources\Json\JsonResource;

class Notify extends JsonResource
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
            'domain_id'  => $this->domain_id,
            'admin_id'   => $this->admin_id,
            'title'      => $this->title,
            'note'       => $this->note,
            'database'   => $this->database,
            'sms'        => $this->sms,
            'edit_uri'   => $this->edit_uri,
            'delete_uri' => $this->delete_uri,
        ];
    }
}
