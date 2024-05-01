<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\Refer\Refer;
use App\Http\Resources\Refer\SimpleRefer;
use Illuminate\Http\Resources\Json\JsonResource;

class Task extends JsonResource
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
            'id'                   => $this->id,
            'creator_admin_id'     => $this->creator_admin_id,
            'creator_fullname'     => optional($this->creator)->fullname,
            'assigned_to_admin_id' => $this->assigned_to_admin_id,
            'receiver_fullname'    => optional($this->receiver)->fullname,
            'description'          => $this->description,
            'start_date'           => $this->start_date_fa,
            'deadline'             => $this->deadline_fa,
            'status'               => $this->status_title,
            'reported_at'          => $this->reported_at_fa,
            'report_status'        => $this->report_status,
            'report_description'   => $this->report_description,
            'file'                 => $this->file,
            'refers'               => SimpleRefer::collection($this->refers),
            'edit_uri'             => $this->edit_uri,
            'delete_uri'           => $this->delete_uri,
        ];
    }
}
