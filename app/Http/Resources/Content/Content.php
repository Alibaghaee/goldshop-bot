<?php

namespace App\Http\Resources\Content;

use Illuminate\Http\Resources\Json\JsonResource;

class Content extends JsonResource
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
            'id'                 => $this->id,
            'category_id'        => $this->category_id,
            'category_item_id'   => $this->category_item_id,
            'html_title'         => $this->html_title,
            'address_slug'       => $this->address_slug,
            'title'              => $this->title,
            'summary'            => $this->summary,
            'body'               => $this->body,
            'image'              => $this->image,
            'file'               => $this->file,
            'active'             => $this->active,
            'edit_uri'           => $this->edit_uri,
            'delete_uri'         => $this->delete_uri,
            'category_item_name' => optional($this->category_item)->title,
            'url'                => $this->url,
            'locale_name'        => $this->locale_name,
        ];
    }
}
