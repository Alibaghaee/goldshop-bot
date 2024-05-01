<?php

namespace App\Http\Resources\ExpertAttendanceDays;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpertAttendanceDays extends JsonResource
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
            'expert_id'            => $this->expert_id,
            'start_date'           => $this->start_date,
            'end_date'             => $this->end_date,
            'saturday_status'      => $this->saturday_status,
            'saturday_start_time'  => $this->saturday_start_time,
            'saturday_end_time'    => $this->saturday_end_time,
            'saturday_room_id'     => $this->saturday_room_id,
            'sunday_status'        => $this->sunday_status,
            'sunday_start_time'    => $this->sunday_start_time,
            'sunday_end_time'      => $this->sunday_end_time,
            'sunday_room_id'       => $this->sunday_room_id,
            'monday_status'        => $this->monday_status,
            'monday_start_time'    => $this->monday_start_time,
            'monday_end_time'      => $this->monday_end_time,
            'monday_room_id'       => $this->monday_room_id,
            'tuesday_status'       => $this->tuesday_status,
            'tuesday_start_time'   => $this->tuesday_start_time,
            'tuesday_end_time'     => $this->tuesday_end_time,
            'tuesday_room_id'      => $this->tuesday_room_id,
            'wednesday_status'     => $this->wednesday_status,
            'wednesday_start_time' => $this->wednesday_start_time,
            'wednesday_end_time'   => $this->wednesday_end_time,
            'wednesday_room_id'    => $this->wednesday_room_id,
            'thursday_status'      => $this->thursday_status,
            'thursday_start_time'  => $this->thursday_start_time,
            'thursday_end_time'    => $this->thursday_end_time,
            'thursday_room_id'     => $this->thursday_room_id,
            'friday_status'        => $this->friday_status,
            'friday_start_time'    => $this->friday_start_time,
            'friday_end_time'      => $this->friday_end_time,
            'friday_room_id'       => $this->friday_room_id,
            'edit_uri'             => $this->edit_uri,
            'delete_uri'           => $this->delete_uri,
        ];
    }
}
