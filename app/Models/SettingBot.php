<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingBot extends Model
{
    use HasFactory;

    protected $fillable = [
        'main',
        'bot_tag'
    ];

    protected $casts = [
        'main' => 'array'
    ];

    public static $MMD_TALA='mmd_tala';

    public function setStartLockTimeAttribute(string $value)
    {
        return $this->setAttribute('main->start_lock_time', $value);
    }

    public function getStartLockTimeAttribute()
    {
        return is_array($this->main) ? (array_key_exists('start_lock_time', $this->main) ? $this->main['start_lock_time'] : null) : null;
    }

    public function setStartLockTime(string $value)
    {
        $this->start_lock_time = $value;
        $this->save();
    }


    public function setStopLockTimeAttribute(string $value)
    {
        return $this->setAttribute('main->stop_lock_time', $value);
    }

    public function getStopLockTimeAttribute()
    {
        return is_array($this->main) ? (array_key_exists('stop_lock_time', $this->main) ? $this->main['stop_lock_time'] : null) : null;
    }

    public function setStopLockTime(string $value)
    {
        $this->stop_lock_time = $value;
        $this->save();
    }

}
