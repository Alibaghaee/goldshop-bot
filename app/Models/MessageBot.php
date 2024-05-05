<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageBot extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'update_id', 'message_id', 'from_id', 'from_is_bot', 'from_first_name', 'from_last_name', 'from_language_code', 'chat_id', 'chat_first_name', 'chat_last_name', 'chat_type', 'date', 'text',];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime',
        'from_is_bot' => 'boolean',
    ];


    protected static function boot()
    {
        parent::boot();

        static::created(function (MessageBot $message) {
            if (!$message->from_is_bot && self::checkLockConversation()) {

                if (trim($message->text) === '/start') {

                    $message->startBot();
                }


            }

        });
    }

    public static function checkLockConversation()
    {

        return true;
    }


    public function startBot()
    {
//        $this;
    }

}
