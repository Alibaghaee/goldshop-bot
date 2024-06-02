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

    public static $MMD_TALA = 'mmd_tala';

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

    public function setCoinMarginAttribute(string $value)
    {
        return $this->setAttribute('main->coin_margin', $value);
    }

    public function getCoinMarginAttribute()
    {
        return is_array($this->main) ? (array_key_exists('coin_margin', $this->main) ? $this->main['coin_margin'] : null) : null;
    }

    public function setCoinMargin(string $value)
    {
        $this->coin_margin = $value;
        $this->save();
    }

    public function setSellingAbshodeAttribute($value)
    {
        return $this->setAttribute('main->selling_abshode', $value);
    }

    public function getSellingAbshodeAttribute()
    {
        return is_array($this->main) ? (array_key_exists('selling_abshode', $this->main) ? $this->main['selling_abshode'] : null) : null;
    }

    public function setSellingAbshode(string $value)
    {
        $this->selling_abshode = $value;
        $this->save();
    }

    public function setBuyingAbshodeAttribute($value)
    {
        return $this->setAttribute('main->buying_abshode', $value);
    }

    public function getBuyingAbshodeAttribute()
    {
        return is_array($this->main) ? (array_key_exists('buying_abshode', $this->main) ? $this->main['buying_abshode'] : null) : null;
    }

    public function setBuyingAbshode($value)
    {
        $this->buying_abshode = $value;
        $this->save();
    }

    public function setSellingGramAttribute($value)
    {
        return $this->setAttribute('main->selling_gram', $value);
    }

    public function getSellingGramAttribute()
    {
        return is_array($this->main) ? (array_key_exists('selling_gram', $this->main) ? $this->main['selling_gram'] : null) : null;
    }

    public function setSellingGram($value)
    {
        $this->selling_gram = $value;
        $this->save();
    }

    public function setBuyingGramAttribute($value)
    {
        return $this->setAttribute('main->buying_gram', $value);
    }

    public function getBuyingGramAttribute()
    {
        return is_array($this->main) ? (array_key_exists('buying_gram', $this->main) ? $this->main['buying_gram'] : null) : null;
    }

    public function setBuyingGram($value)
    {
        $this->buying_gram = $value;
        $this->save();
    }

    public function setSellingCoinAttribute($value)
    {
        return $this->setAttribute('main->selling_coin', $value);
    }

    public function getSellingCoinAttribute()
    {
        return is_array($this->main) ? (array_key_exists('selling_coin', $this->main) ? $this->main['selling_coin'] : null) : null;
    }

    public function setSellingCoin($value)
    {
        $this->selling_coin = $value;
        $this->save();
    }

    public function setBuyingCoinAttribute($value)
    {
        return $this->setAttribute('main->buying_coin', $value);
    }

    public function getBuyingCoinAttribute()
    {
        return is_array($this->main) ? (array_key_exists('buying_coin', $this->main) ? $this->main['buying_coin'] : null) : null;
    }

    public function setBuyingCoin($value)
    {
        $this->buying_coin = $value;
        $this->save();
    }

    public function setAbshodeMarginAttribute(string $value)
    {
        return $this->setAttribute('main->abshode_margin', $value);
    }

    public function getAbshodeMarginAttribute()
    {
        return is_array($this->main) ? (array_key_exists('abshode_margin', $this->main) ? $this->main['abshode_margin'] : null) : null;
    }

    public function setAbshodeMargin(string $value)
    {
        $this->abshode_margin = $value;
        $this->save();
    }

    public function setCoinBalanceAttribute(string $value)
    {
        return $this->setAttribute('main->coin_balance', $value);
    }

    public function getCoinBalanceAttribute()
    {
        return is_array($this->main) ? (array_key_exists('coin_balance', $this->main) ? $this->main['coin_balance'] : null) : null;
    }

    public function setCoinBalance(string $value)
    {
        $this->coin_balance = $value;
        $this->save();
    }

    public function setAbshodeBalanceAttribute(string $value)
    {
        return $this->setAttribute('main->abshode_balance', $value);
    }

    public function getAbshodeBalanceAttribute()
    {
        return is_array($this->main) ? (array_key_exists('abshode_balance', $this->main) ? $this->main['abshode_balance'] : null) : null;
    }

    public function setAbshodeBalance(string $value)
    {
        $this->abshode_balance = $value;
        $this->save();
    }

}
