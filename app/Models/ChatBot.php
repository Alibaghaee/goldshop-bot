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
        'chat_id', 'chat_first_name', 'chat_last_name', 'chat_type',
    ];

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
     * Define a one-to-one relationship to ChatSession.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function chatSession()
    {
        return $this->hasOne(ChatSession::class);
    }
}
