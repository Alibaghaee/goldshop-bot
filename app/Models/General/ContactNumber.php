<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\HasPublishedScope;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class ContactNumber extends Model
{
    use Uri, View, Filterable, HasPublishedScope;

    protected $route_name = 'contact_numbers';


    public static $STATUS_LIST = [
        ['id' => 'pending', 'name' => 'غیرفعال'],
        ['id' => 'published', 'name' => 'فعال'],
    ];

    public static $GENDER_LIST = [
        ['id' => 'male', 'name' => 'آقا'],
        ['id' => 'female', 'name' => 'خانم'],
    ];


    public function contactCategory()
    {
        return $this->belongsTo(ContactCategory::class);
    }


    public static function getStatusArray($id)
    {
        if (collect(self::$STATUS_LIST)
                ->where('id', $id)->count() > 0) {

            return collect(self::$STATUS_LIST)
                ->where('id', $id)
                ->first();
        }
        return [];
    }


    public function transWithList($id, array $list)
    {
        if (collect($list)
                ->where('id', $id)->count() > 0) {

            return collect($list)
                ->where('id', $id)
                ->first()['name'];
        }
        return 'undefined';
    }


    public function getStatusFaAttribute()
    {
        return $this->transWithList($this->status, self::$STATUS_LIST);
    }

    public function getGenderFaAttribute()
    {
        return $this->transWithList($this->gender, self::$GENDER_LIST);
    }

    public function setGenderWithIdAttribute($value)
    {
        if ($value == '1') {

            $value = 'male';
        } else {
            $value = 'female';
        }
        $this->setAttribute('gender', $value);
    }

    public function setNumberAttribute($value)
    {

        $this->setAttribute('mobile', str_replace("+98", "0", $value));
    }


    public static function scopeAsGroupOption($query)
    {

        return $query->select('name', 'id');
    }

    protected $guarded = [];

    // {{dont_delete_this_comment}}
}
