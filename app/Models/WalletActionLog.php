<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class WalletActionLog extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'amount',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function (WalletActionLog $model) {

            $model->setAttribute('uuid', (string)Str::Uuid());
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function checkActivity(int $userId)
    {
        $q=self::where('status','open')
            ->where('user_id',$userId)->orderByDesc('created_at');
        if ($q->exists()){

            return $q->first()->created_at < Carbon::now()->subMinutes(5);
        }else{

            return true;
        }
    }
}
