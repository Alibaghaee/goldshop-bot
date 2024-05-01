<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Operator;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class Operator20002 extends Model
{
    use Uri, View, Filterable, Operator;

    protected $table = 'md_sms_deliver_20002';

    protected $guarded = [];

    public $timestamps = false;

    protected $appends = ['admin_blacklist_price', 'user_blacklist_price'];

    public function __construct()
    {
        $this->connection = config('portal.5m5_db_connection');
    }
}
