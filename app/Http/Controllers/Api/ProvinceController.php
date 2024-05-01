<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\General\Province;

class ProvinceController extends Controller
{
    public function getProvinces()
    {
        return Province::asOption();
    }

    public function getCities(Province $province)
    {
        return $province->cities()->asOption();
    }
}
