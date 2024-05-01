<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use App\Traits\NewsLetter\HasNewsLetter;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use Uri, View, Filterable, HasNewsLetter;

    protected $route_name = 'drivers';

    protected $guarded = [];

    protected $appends = [
        'full_name',
        'show_travels_uri'
    ];

    public static $STATUS_LIST = [
        ['id' => 'enable', 'name' => 'فعال'],
        ['id' => 'disable', 'name' => 'غیرفعال'],
    ];

    public function getStatusFaAttribute()
    {

        return collect(self::$STATUS_LIST)
            ->where('id', $this->getAttribute('status'))
            ->first()['name'];
    }


    public static function scopeAsOption($query)
    {
        return $query->select('id', \DB::raw("CONCAT(first_name, ' ', last_name ,' - ',mobile) as name"))->get();
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getShowTravelsUriAttribute()
    {
        if ($this->id) {

            return route('drivers.showTravels', $this->id);
        }
    }

    /**
     * Define a one-to-many relationship to Travels.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function travels()
    {
        return $this->hasMany(Travel::class);
    }

    // {{dont_delete_this_comment}}
}
