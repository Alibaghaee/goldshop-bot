<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoute extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'chat_session_id',
        'action',
    ];

    protected $touches=[
        'chatSession'
    ];

    /**
     * Define an inverse one-to-one or many relationship to ChatSession.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chatSession()
    {
        return $this->belongsTo(ChatSession::class);
    }
}
