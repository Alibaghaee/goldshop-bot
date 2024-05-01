<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class SmsAdmin extends Model
{
    use Uri, View, Filterable;

    protected $table = 'md_admin';

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

    public function blacklistPrice()
    {
        return $this->hasOne('App\Models\General\AdminBlacklistPrice', 'admin_id', 'id');
    }
}
