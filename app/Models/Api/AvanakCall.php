<?php

namespace App\Models\Api;

use App\Models\Api\AvanakCallDetail;
use App\Rahco\Call\Avanak;
use Illuminate\Database\Eloquent\Model;

class AvanakCall extends Model
{
    protected $guarded = [];

    public function details()
    {
        return $this->hasMany('App\Models\Api\AvanakCallDetail');
    }

    public function voice()
    {
        return $this->belongsTo('App\Models\Api\AvanakVoice', 'voice_id');
    }

    public function mobiles()
    {
        return $this->details->pluck('mobile')->toArray();
    }

    public static function createCall($voice_id, $mobiles, int $user_id, $admin_price, $user_price, $retry_count = 0)
    {
        // find voice
        $voice = AvanakVoice::where('voice_id', $voice_id)->firstOrfail();

        // create call
        $avanak_call = static::create([
            'retry_count' => $retry_count,
            'user_id'     => $user_id,
            'voice_id'    => $voice->id,
            'admin_price' => $admin_price,
            'user_price'  => $user_price,
        ]);

        // create call detail
        $now                = now();
        $avanak_call_details = collect($mobiles)->map(function ($value) use ($avanak_call, $now) {
            return [
                'avanak_call_id' => $avanak_call->id,
                'mobile'        => $value,
                'created_at'    => $now,
                'updated_at'    => $now,
            ];
        })->toArray();

        AvanakCallDetail::insert($avanak_call_details);

        return $avanak_call;
    }

    public function scopeUnsended($query)
    {
        return $query->where('status', 0);
    }

    public function updateToSended()
    {
        $this->status = 1;
        return $this->save();
    }

    public static function callQueue()
    {
        return static::with('voice')->unsended()->get();
    }

    public function allMobiles()
    {
        return collect($this->details()->unsended()->pluck('mobile')->toArray());
    }

    public function updateMobilesToSended($mobiles)
    {
        return $this->details()->whereIn('mobile', $mobiles)->updateToSended();
    }

    public function sendCallRequests($mobiles)
    {
        return (new Avanak)->sendBatchCallRequest($mobiles->toArray(), $this->voice->voice_id, $this->retry_count);
    }

    public function sendForMobiles($mobiles)
    {
        $this->updateMobilesToSended($mobiles);
        return $this->sendCallRequests($mobiles);
    }


}
