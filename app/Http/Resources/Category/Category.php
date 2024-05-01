<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
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
            'id'           => $this->id,
            'module_id'    => $this->module_id,
            'module_title' => optional($this->module)->title,
            'title'        => $this->title,
            'items_count'  => $this->items_count,
            'items_uri'    => $this->items_uri,
            'order_uri'    => $this->order_uri,
            'edit_uri'     => $this->edit_uri,
            'delete_uri'   => $this->delete_uri,
        ];
    }
}
