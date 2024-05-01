<?php

namespace App\Http\Resources\NewsLetter;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsLetter extends JsonResource
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
            'message' => $this->message,
            'status' => $this->status,
            'statusFa' => $this->status_fa,
            'totalUsers' => $this->users()->count(),
            'totalDrivers' => $this->drivers()->count(),
            //
            'edit_uri' => $this->edit_uri,
            'delete_uri' => $this->delete_uri,
        ];
    }
}
