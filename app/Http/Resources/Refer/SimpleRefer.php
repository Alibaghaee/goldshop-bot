<?php

namespace App\Http\Resources\Refer;

use App\Http\Resources\Task\Task;
use Illuminate\Http\Resources\Json\JsonResource;

class SimpleRefer extends JsonResource
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
            'from_fullname'             => $this->from->fullname,
            'to_fullname'               => $this->to->fullname,
            'description'               => $this->description,
            'only_visible_for_receiver' => $this->only_visible_for_receiver,
            'file'                      => $this->file,
            'rate'                      => $this->rate,
            'referred'                  => $this->referred,
            'created_at'                => $this->created_at_fa,
            'task_deadline'             => $this->task->deadline_fa,
            'edit_uri'                  => $this->edit_uri,
            'delete_uri'                => $this->delete_uri,
        ];
    }
}
