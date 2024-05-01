<?php

namespace App\Http\Resources\Answer;

use Illuminate\Http\Resources\Json\JsonResource;

class Answer extends JsonResource
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
            'id'                => $this->id,
            'ticket_id'         => $this->ticket_id,
            'creator_id'        => $this->creator_id,
            'receiver_id'       => $this->receiver_id,
            'creator_fullname'  => optional($this->creator)->fullname,
            'receiver_fullname' => optional($this->receiver)->fullname,
            'title'             => $this->title,
            'body'              => $this->body,
            'file'              => $this->file,
            'created_at'        => $this->created_at_fa,
            'updated_at'        => $this->updated_at_fa,
            'edit_uri'          => $this->edit_uri,
            'delete_uri'        => $this->delete_uri,
        ];
    }
}
