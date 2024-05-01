<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessAgentToken extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'token',
        'expires_in',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'expires_in' => 'integer'
    ];

    public static function setToken($data)
    {


        return self::create([
            'token' => $data['token'],
            'expires_in' => $data['expires_in'],
            'user_id' => $data['user_id'],
        ]);
    }

    public static function getToken($data)
    {
        return self::where('user_id', $data['user_id'])->orderByDesc('created_at')->first();
    }
}
