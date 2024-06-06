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

    public function setUnitAttribute(string $value)
    {
        return $this->setAttribute('data->unit', $value);
    }

    public function getUnitAttribute()
    {
        return is_array($this->data) ? (array_key_exists('unit', $this->data) ? $this->data['unit'] : null) : null;
    }


    public function setUnit(string $value)
    {
        $this->unit = $value;
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

    public function setBalanceTypeAttribute(string $value)
    {
        return $this->setAttribute('data->balance_type', $value);
    }

    public function getBalanceTypeAttribute()
    {
        return is_array($this->data) ? (array_key_exists('balance_type', $this->data) ? $this->data['balance_type'] : null) : null;
    }


    public function setBalanceType(string $value)
    {
        $this->balance_type = $value;
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

  public function setFactorAttribute(string $value)
    {
        return $this->setAttribute('data->factor', $value);
    }

    public function getFactorAttribute()
    {
        return is_array($this->data) ? (array_key_exists('factor', $this->data) ? $this->data['factor'] : null) : null;
    }


    public function setFactor(string $value)
    {
        $this->factor = $value;
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

    public function setStartManualOrderAttribute(bool $value)
    {
        return $this->setAttribute('data->start_manual_order', $value);
    }

    public function getStartManualOrderAttribute()
    {
        return is_array($this->data) ? (array_key_exists('start_manual_order', $this->data) ? $this->data['start_manual_order'] : null) : null;
    }


    public function setStartManualOrder(bool $value)
    {
        $this->start_manual_order = $value;
        $this->save();
    }

    public function setUserIdManualOrderAttribute(int $value)
    {
        return $this->setAttribute('data->user_id_manual_order', $value);
    }

    public function getUserIdManualOrderAttribute()
    {
        return is_array($this->data) ? (array_key_exists('user_id_manual_order', $this->data) ? $this->data['user_id_manual_order'] : null) : null;
    }


    public function setUserIdManualOrder(int $value)
    {
        $this->user_id_manual_order = $value;
        $this->save();
    }

    public function setItemManualOrderAttribute(string $value)
    {
        return $this->setAttribute('data->item_manual_order', $value);
    }

    public function getItemManualOrderAttribute()
    {
        return is_array($this->data) ? (array_key_exists('item_manual_order', $this->data) ? $this->data['item_manual_order'] : null) : null;
    }


    public function setItemManualOrder(string $value)
    {
        $this->item_manual_order = $value;
        $this->save();
    }

    public function setTypeManualOrderAttribute(string $value)
    {
        return $this->setAttribute('data->type_manual_order', $value);
    }

    public function getTypeManualOrderAttribute()
    {
        return is_array($this->data) ? (array_key_exists('type_manual_order', $this->data) ? $this->data['type_manual_order'] : null) : null;
    }


    public function setTypeManualOrder(string $value)
    {
        $this->type_manual_order = $value;
        $this->save();
    }

    public function setPriceManualOrderAttribute(float $value)
    {
        return $this->setAttribute('data->price_manual_order', $value);
    }

    public function getPriceManualOrderAttribute()
    {
        return is_array($this->data) ? (array_key_exists('price_manual_order', $this->data) ? $this->data['price_manual_order'] : null) : null;
    }


    public function setPriceManualOrder(float $value)
    {
        $this->price_manual_order = $value;
        $this->save();
    }

    public function setAbshodeWeightManualOrderAttribute(float $value)
    {
        return $this->setAttribute('data->abshode_weight_manual_order', $value);
    }

    public function getAbshodeWeightManualOrderAttribute()
    {
        return is_array($this->data) ? (array_key_exists('abshode_weight_manual_order', $this->data) ? $this->data['abshode_weight_manual_order'] : null) : null;
    }


    public function setAbshodeWeightManualOrder(float $value)
    {
        $this->abshode_weight_manual_order = $value;
        $this->save();
    }

    public function setAbshodePriceManualOrderAttribute(float $value)
    {
        return $this->setAttribute('data->abshode_price_manual_order', $value);
    }

    public function getAbshodePriceManualOrderAttribute()
    {
        return is_array($this->data) ? (array_key_exists('abshode_price_manual_order', $this->data) ? $this->data['abshode_price_manual_order'] : null) : null;
    }


    public function setAbshodePriceManualOrder(float $value)
    {
        $this->abshode_price_manual_order = $value;
        $this->save();
    }

    public function setTotalInvoiceManualOrderAttribute(string $value)
    {
        return $this->setAttribute('data->total_invoice_manual_order', $value);
    }

    public function getTotalInvoiceManualOrderAttribute()
    {
        return is_array($this->data) ? (array_key_exists('total_invoice_manual_order', $this->data) ? $this->data['total_invoice_manual_order'] : null) : null;
    }


    public function setTotalInvoiceManualOrder(string $value)
    {
        $this->total_invoice_manual_order = $value;
        $this->save();
    }

    public function setCoinAmountManualOrderAttribute(string $value)
    {
        return $this->setAttribute('data->coin_amount_manual_order', $value);
    }

    public function getCoinAmountManualOrderAttribute()
    {
        return is_array($this->data) ? (array_key_exists('coin_amount_manual_order', $this->data) ? $this->data['coin_amount_manual_order'] : null) : null;
    }


    public function setCoinAmountManualOrder(string $value)
    {
        $this->coin_amount_manual_order = $value;
        $this->save();
    }
}
