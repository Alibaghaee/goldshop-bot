<?php

namespace App\Http\Resources\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class Report extends JsonResource
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
            'id'               => $this->id,
            'title'            => $this->title,
            'chart_type'       => $this->chart_type,
            'chart_type_title' => $this->chart_type_title,
            'criteria'         => $this->criteria,
            'note'             => $this->note,
            'status'           => $this->status,
            'code_state'       => $this->code_state,
            'product_group_id' => $this->product_group_id,
            'product_id'       => $this->product_id,
            'date_from'        => $this->date_from_fa,
            'date_to'          => $this->date_to_fa,
            'criteria_md5'     => $this->criteria_md5,
            'result'           => $this->result,
            'file'             => $this->file,
            'status'           => $this->status,
            'status_title'     => $this->status_title,
            'file_status'      => $this->file_status,
            'percent'          => $this->percent,
            'created_at_fa'    => $this->created_at_fa,
            'edit_uri'         => $this->edit_uri,
            'delete_uri'       => $this->delete_uri,
            'show_uri'         => $this->show_uri,
            'get_file_uri'     => $this->get_file_uri,
        ];
    }
}
