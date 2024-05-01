<?php

namespace App\Http\Resources\NetworkActivity;

use App\Models\General\Map;
use Illuminate\Http\Resources\Json\JsonResource;

class NetworkActivity extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

         return [
            'id' => $this->id,
            'title'=>$this->title,
            'mapCode' => $this->when(get_class($this->networkActivitiable) === Map::class,
            function (){

                return optional($this->networkActivitiable)->code;
            }
            ),

            'createdAt'=>$this->created_at_fa,


            'show_clone_uri'=>   optional($this->networkActivitiable)->showCloneUri($this->id),
            'edit_uri'   => '',
            'delete_uri' => '',

        ];
    }
}
