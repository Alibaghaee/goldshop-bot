<?php

namespace App\Http\Resources\LotteryOne;

use Illuminate\Http\Resources\Json\JsonResource;

class LotteryOne extends JsonResource
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
            'id'           => $this->id,
            'title'        => $this->title,
            'step'         => $this->step,
            'date'         => $this->date_fa,
            'created_at'   => $this->created_at_fa,
            'status'       => $this->status,
            'status_title' => $this->status_title,
            'file'         => $this->file,
            'count'        => $this->count,
            'percent'      => $this->percent,
            'winner_data'  => $this->winner_data,
            'edit_uri'     => $this->edit_uri,
            'delete_uri'   => $this->delete_uri,
            'show_uri'     => $this->show_uri,
            'get_file_uri' => $this->get_file_uri,
        ];
    }
}
