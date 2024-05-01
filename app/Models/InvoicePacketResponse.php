<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicePacketResponse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'response',
        'http_response_code',
        'invoice_packet_id',
    ];

    /**
     * Define an inverse one-to-many relationship to InvoicePacket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoicePacket()
    {
        return $this->belongsTo(InvoicePacket::class);
    }
}
