<?php

namespace App\Http\Resources\Map;

use Illuminate\Http\Resources\Json\JsonResource;

class Map extends JsonResource
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
            'id'             => $this->id,
            'code'           => $this->code,
            'region'         => $this->region,
            'address'        => $this->address,
            'location_x'     => explode(',', $this->lat_long ?? '')[0],
            'location_y'     => explode(',', $this->lat_long ?? '')[1],
            'color'          => $this->color,
            'mesh'           => $this->mesh,
            'banner'         => $this->banner,
            'cerline'        => $this->cerline,
            'visitor'        => $this->visitor,
            'visit_date'     => $this->visit_date_fa,
            'installer'      => $this->installer,
            'install_date'   => $this->install_date_fa,
            'data'           => $this->data,
            'image'          => $this->image,
            'lat_long'          => $this->lat_long,
            'map_uri'        => $this->map_uri,
            'neshan_map_uri' => $this->neshan_map_uri,
            'isSoftDelete' => $this->is_soft_delete,
            'created_at'     => $this->created_at_fa,
            'index_clone_uri'       => route('maps.indexClone',$this->id),
            'edit_uri'       => $this->edit_uri,
            'delete_uri'     => $this->delete_uri,
            'restore_uri'     => route('maps.restore',$this->id),
            'force_delete_uri'     => route('maps.forceDelete',$this->id),
        ];
    }
}
