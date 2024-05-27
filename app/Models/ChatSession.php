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
        'data',
    ];

    protected $appends = [
        'item',
        'start_bot',
        'start_trade',
        'start_trade',
        'type',
        'coin_amount',
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


    public function setItemAttribute(string $value)
    {
        return $this->setAttribute('data->item', $value);
    }

    public function getItemAttribute()
    {
        return is_array($this->data) ? (array_key_exists('item', $this->data) ? $this->data['item'] : null) : null;
    }


    public function setItem(string $value)
    {
        $this->item = $value;
        $this->save();
    }


    public function setTypeAttribute(string $value)
    {
        return $this->setAttribute('data->type', $value);
    }

    public function getTypeAttribute()
    {
        return is_array($this->data) ? (array_key_exists('type', $this->data) ? $this->data['type'] : null) : null;
    }


    public function setType(string $value)
    {
        $this->type = $value;
        $this->save();
    }


    public function setCoinAmountAttribute(string $value)
    {
        return $this->setAttribute('data->coin_amount', $value);
    }

    public function getCoinAmountAttribute()
    {
        return is_array($this->data) ? (array_key_exists('coin_amount', $this->data) ? $this->data['coin_amount'] : null) : null;
    }


    public function setCoinAmount(string $value)
    {
        $this->coin_amount = $value;
        $this->save();
    }

    public function setWeightAttribute(string $value)
    {
        return $this->setAttribute('data->weight', $value);
    }

    public function getWeightAttribute()
    {
        return is_array($this->data) ? (array_key_exists('weight', $this->data) ? $this->data['weight'] : null) : null;
    }


    public function setWeight(string $value)
    {
        $this->weight = $value;
        $this->save();
    }

    public function setPriceAttribute(string $value)
    {
        return $this->setAttribute('data->price', $value);
    }

    public function getPriceAttribute()
    {
        return is_array($this->data) ? (array_key_exists('price', $this->data) ? $this->data['price'] : null) : null;
    }


    public function setPrice(string $value)
    {
        $this->price = $value;
        $this->save();
    }

    public function setUserMobileAttribute(string $value)
    {
        return $this->setAttribute('data->user_mobile', $value);
    }

    public function getUserMobileAttribute()
    {
        return is_array($this->data) ? (array_key_exists('user_mobile', $this->data) ? $this->data['user_mobile'] : null) : null;
    }


    public function setUserMobile(string $value)
    {
        $this->user_mobile = $value;
        $this->save();
    }

    public function setMarginTypeAttribute(string $value)
    {
        return $this->setAttribute('data->margin_type', $value);
    }

    public function getMarginTypeAttribute()
    {
        return is_array($this->data) ? (array_key_exists('margin_type', $this->data) ? $this->data['margin_type'] : null) : null;
    }


    public function setMarginType(string $value)
    {
        $this->margin_type = $value;
        $this->save();
    }

    public function setTotalInvoiceAttribute(string $value)
    {
        return $this->setAttribute('data->total_invoice', $value);
    }

    public function getTotalInvoiceAttribute()
    {
        return is_array($this->data) ? (array_key_exists('total_invoice', $this->data) ? $this->data['total_invoice'] : null) : null;
    }


    public function setTotalInvoice(string $value)
    {
        $this->total_invoice = $value;
        $this->save();
    }


    public function setStartBotAttribute(bool $value)
    {
        return $this->setAttribute('data->start_bot', $value);
    }

    public function getStartBotAttribute()
    {
        return is_array($this->data) ? (array_key_exists('start_bot', $this->data) ? $this->data['start_bot'] : null) : null;
    }


    public function setStartBot(bool $value)
    {
        $this->start_bot = $value;
        $this->save();
    }

    public function setStartTradeAttribute(bool $value)
    {
        return $this->setAttribute('data->start_trade', $value);
    }

    public function getStartTradeAttribute()
    {
        return is_array($this->data) ? (array_key_exists('start_trade', $this->data) ? $this->data['start_trade'] : null) : null;
    }


    public function setStartTrade(bool $value)
    {
        $this->start_trade = $value;
        $this->save();
    }
}
