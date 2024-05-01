<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Support\Arr;
use Jenssegers\Mongodb\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Lottery extends Model
{
    use Uri, View, Filterable;

    protected $connection = 'mongodb';

    protected $collection = 'lottery';

    // protected $primaryKey = 'id';

    protected $route_name = 'lottery';

    protected $appends = ['mobile_masked', 'position'];

    protected $guarded = [];

    public function getCreatedAtFaAttribute()
    {
        return Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i:s');
    }

    public function getMobileMaskedAttribute()
    {
        return mask_number($this->mobile);
    }

    public function getPositionAttribute()
    {
        $positions = [
            1  => 'اول',
            2  => 'دوم',
            3  => 'سوم',
            4  => 'چهارم',
            5  => 'پنجم',
            6  => 'ششم',
            7  => 'هفتم',
            8  => 'هشتم',
            9  => 'نهم',
            10 => 'دهم',
        ];
        
        return Arr::get($positions, $this->group);
    }

    // {{dont_delete_this_comment}}
}
