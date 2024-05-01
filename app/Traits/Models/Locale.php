<?php

namespace App\Traits\Models;

use Illuminate\Support\Arr;

trait Locale
{
    public function getLocaleNameAttribute()
    {
        return  Arr::get(config('portal.locales'), $this->locale_id);
    }
}
