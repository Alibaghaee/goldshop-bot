<?php

namespace App\Http\Resources\BlacklistSendLog;

use Illuminate\Http\Resources\Json\JsonResource;

class BlacklistSendLog extends JsonResource
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
            'admin_fullname'    => optional($this->admin)->fullname,
            'blacklist_id'      => $this->blacklist_id,
            'note'              => $this->note,
            'send_type'         => $this->send_type,
            'user_price'        => $this->user_price,
            'admin_price'       => $this->admin_price,
            'receivers_count'   => $this->receivers_count,
            'note_parts'        => $this->note_parts,
            'total_note_parts'  => $this->total_note_parts,
            'user_total_price'  => $this->user_total_price,
            'admin_total_price' => $this->admin_total_price,
            'export_file'       => $this->export_file,
            'created_at_fa'     => $this->created_at_fa,
            'export_file_uri'   => $this->export_file_uri,
            // 'edit_uri'          => $this->edit_uri,
            // 'delete_uri'        => $this->delete_uri,
        ];
    }
}
