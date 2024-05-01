<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class UserBilling extends Model
{
    // protected $connection = '5m5';

    protected $guarded = [];

    public $timestamps = false;

    public function __construct()
    {
        $time_y = Jalalian::fromCarbon(now())->format('Y');
        $time_m = (int) Jalalian::fromCarbon(now())->format('m');

        $table_name = 'md_billing_0__' . $time_y . "_" . $time_m;

        $this->setTable($table_name);
    }
}
