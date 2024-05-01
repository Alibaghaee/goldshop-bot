<?php

namespace App\Http\Resources\TabiatProductCategory;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TabiatProductCategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
