<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'chat_bot_id',
        'data',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array'
    ];

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (ChatSession $session) {

            $session->chatRoutes?->each->delete();
        });
    }


    /**
     * Define a one-to-many relationship to ChatRoute.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chatRoutes()
    {
        return $this->hasMany(ChatRoute::class);
    }
}
