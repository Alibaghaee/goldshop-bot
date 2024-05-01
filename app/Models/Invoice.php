<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'invoice_packet_id'
    ];


    /**
     * Define an inverse one-to-many relationship to InvoicePacket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoicePacket()
    {
        return $this->BelongsTo(InvoicePacket::class);
    }

    /**
     * Define a one-to-one relationship to InvoiceHeader.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function invoiceHeader()
    {
        return $this->hasOne(InvoiceHeader::class);
    }

    /**
     * Define a one-to-one relationship to InvoiceBody.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function invoiceBody()
    {
        return $this->hasOne(InvoiceBody::class);
    }

    /**
     * Define a one-to-one relationship to InvoicePayment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function invoicePayment()
    {
        return $this->hasOne(InvoicePayment::class);
    }
}
