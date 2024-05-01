<?php

namespace App\Http\Resources\MapClone;

use Illuminate\Http\Resources\Json\JsonResource;

class MapClone extends JsonResource
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
            'id'         => $this->id,
            'name'         => $this->whenLoaded('networkActivity',function (){
                return $this->networkActivity->adminProfile->name;
            }),
            'username'         => $this->whenLoaded('networkActivity',function (){
                return $this->networkActivity->adminProfile->username;
            }),
            'email'         => $this->whenLoaded('networkActivity',function (){
                return $this->networkActivity->adminProfile->email;
            }),


            'createdAt'=>$this->created_at_fa,
            //
            'show_clone_uri'=> route('maps.showClone',$this->id),
            'show_uri' => '',
            'edit_uri' => '',
            'delete_uri' => '',

        ];
    }
}
