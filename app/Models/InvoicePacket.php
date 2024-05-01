<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicePacket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'status',
        'packet_type',
        'account_id',
    ];


    public static $STATUS_LIST = [
        ['id' => 'pending', 'name' => 'درانتظار'],
        ['id' => 'pending_register', 'name' => 'درانتظار ثبت'],
        ['id' => 'registered', 'name' => 'ثبت شده'],
        ['id' => 'not_registered', 'name' => 'ثبت نشده'],
    ];


    public function getStatusFaAttribute()
    {

        return collect(self::$STATUS_LIST)
            ->where('id', $this->getAttribute('status'))
            ->first()['name'];
    }

    public function getStatusStyleClassAttribute()
    {
        if ($this->status === 'not_registered') {

            return 'text-red';
        } elseif ($this->status === 'pending') {

            return 'text-yellow';
        } elseif ($this->status === 'pending_register') {

            return 'text-orange';
        } elseif ($this->status === 'registered') {

            return 'text-green';
        }
    }


    /**
     * Define a one-to-many relationship to Invoice.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }


    /**
     * Define an inverse one-to-many relationship to Account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }


    /**
     * Define a one-to-many relationship to InvoicePacketResponse.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoicePacketResponses()
    {
        return $this->hasMany(InvoicePacketResponse::class);
    }

}
