<?php

namespace App\ImageFilters;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class ExtraSmall implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(120, 90);
    }
}
