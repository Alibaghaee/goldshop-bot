<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class UserBlacklistPrice extends Model
{
    protected $table = 'md_user_blacklist_price';

    protected $guarded = [];

    public $timestamps = false;

    public function __construct()
    {
        $this->connection = config('portal.5m5_db_connection');
    }
}
