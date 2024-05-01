<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class SmsUser extends Model
{
    use Uri, View, Filterable;

    protected $table = 'md_user';

    protected $guarded = [];

    public $timestamps = false;

    public function __construct()
    {
        $this->connection = config('portal.5m5_db_connection');
    }

    public function hasCash($value)
    {
        return $this->cash >= $value;
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\General\SmsAdmin', 'adminid', 'id');
    }

    public function blacklistPrice()
    {
        return $this->hasOne('App\Models\General\UserBlacklistPrice', 'user_id', 'id');
    }

    public function getBlacklistPriceForUserAttribute()
    {
        return ($this->blacklistPrice['user_price'] ?? $this->admin->blacklistPrice['user_price'] ) ?? null;
    }

    public function getBlacklistPriceForAdminAttribute()
    {
        return ($this->blacklistPrice['admin_price'] ?? $this->admin->blacklistPrice['admin_price']) ?? null;
    }
}
