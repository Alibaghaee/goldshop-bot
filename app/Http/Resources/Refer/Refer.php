<?php

namespace App\Http\Resources\Refer;

use App\Http\Resources\Task\Task;
use Illuminate\Http\Resources\Json\JsonResource;

class Refer extends JsonResource
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
            'id'                        => $this->id,
            'task_id'                   => $this->task_id,
            'from_fullname'             => optional($this->from)->fullname,
            'to_fullname'               => optional($this->to)->fullname,
            'description'               => $this->description,
            'only_visible_for_receiver' => $this->only_visible_for_receiver,
            'file'                      => $this->file,
            'rate'                      => $this->rate,
            'referred'                  => $this->referred,
            'created_at'                => $this->created_at_fa,
            'task_deadline'             => optional($this->task)->deadline_fa,
            'task'                      => new Task($this->task),
            'edit_uri'                  => $this->edit_uri,
            'store_uri'                 => $this->store_uri,
            'delete_uri'                => $this->delete_uri,
            'update_uri'                => $this->update_uri,
        ];
    }
}
