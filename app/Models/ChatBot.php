<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatBot extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'chat_id', 'chat_first_name', 'chat_last_name', 'chat_type', 'chat_session_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (ChatBot $chatBot) {


            $chatBot->setAttribute('chat_session_id', ChatSession::create()->id);

        });

    }

    /**
     * Define an inverse one-to-one or many relationship to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define a inverse one-to-one relationship to ChatSession.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chatSession()
    {
        return $this->belongsTo(ChatSession::class);
    }
}
