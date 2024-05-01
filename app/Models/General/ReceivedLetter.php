<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class ReceivedLetter extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'received_letters';

    protected $dates = ['date'];

    protected $guarded = [];

    public function getDateFaAttribute()
    {
        return Jalalian::fromCarbon($this->date)->format('Y/m/d');
    }

    // {{dont_delete_this_comment}}
}
