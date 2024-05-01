<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SenderActionLog extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message',
        'status',
        'user_id',
        'mobile',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *Check with user
     * @return boolean
     **/
    public static function checkActionWithUser(User $user)
    {

        return self::query()
                ->where('user_id', $user->id)
                ->where('created_at', '>=', now()->subMinute())
                ->count() >= 10;
    }

    /**
     *Check with mobile
     * @return boolean
     **/
    public static function checkActionWithMobile(string $mobile)
    {
        return self::query()
                ->where('mobile', $mobile)
                ->where('created_at', '>=', now()->subMinute())
                ->count() >= 10;
    }
}
