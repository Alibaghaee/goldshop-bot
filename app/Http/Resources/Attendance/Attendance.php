<?php

namespace App\Http\Resources\Attendance;

use Illuminate\Http\Resources\Json\JsonResource;

class Attendance extends JsonResource
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
            'id'                  => $this->id,
            'admin_id'            => $this->admin_id,
            'entry_date'          => $this->entry_date_fa,
            'entry_day'           => $this->entry_day_fa,
            'entry_time'          => $this->entry_time,
            'exit_time'           => $this->exit_time,
            'arranged_enter_time' => $this->arranged_enter_time,
            'arranged_exit_time'  => $this->arranged_exit_time,
            'admin_fullname'      => optional($this->admin)->fullname,
            'edit_uri'            => $this->edit_uri,
            'delete_uri'          => $this->delete_uri,
        ];
    }
}
