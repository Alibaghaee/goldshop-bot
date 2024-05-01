<?php

namespace App\Http\Resources\AdminProfile;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminProfile extends JsonResource
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
            'name' => $this->whenLoaded('admin', function () {
                return $this->admin->name;
            }),
            'username' => $this->whenLoaded('admin', function () {
                return $this->admin->username;
            }),
            'email' => $this->whenLoaded('admin', function () {
                return $this->admin->email;
            }),


            //
            'show_uri' => route('admin_profiles.show', $this->id),
            'edit_uri' => $this->edit_uri,
            'delete_uri' => $this->delete_uri,
        ];
    }
}
