<?php

namespace App\Http\Resources\Ticket;

use Illuminate\Http\Resources\Json\JsonResource;

class Ticket extends JsonResource
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
            'status_title'      => $this->status_title,
            'created_at'        => $this->created_at_fa,
            'updated_at'        => $this->updated_at_fa,
            'edit_uri'          => $this->edit_uri,
            'delete_uri'        => $this->delete_uri,
            'items_count'       => $this->items_count,
            'items_uri'         => $this->items_uri,
            'item_create_uri'   => $this->item_create_uri,
        ];
    }
}
