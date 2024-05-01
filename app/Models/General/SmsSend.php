<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Jenssegers\Mongodb\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class SmsSend extends Model
{
    use Uri, View, Filterable;

    protected $connection = 'mongodb';

    protected $collection = 'sms_sends';

    // protected $primaryKey = 'id';

    protected $route_name = 'sms_sends';

    protected $guarded = [];

    public function getCreatedAtFaAttribute()
    {
        return Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i:s');
    }

    public function send()
    {
        $sms_id = sms($this->mobile, $this->note);

        return $this->update([
            'status' => 1,
            'sms_id' => $sms_id
        ]);
    }

    public function sended($sms_id)
    {
        return $this->update([
            'status' => 1,
            'sms_id' => $sms_id
        ]);
    }

    // {{dont_delete_this_comment}}
}
