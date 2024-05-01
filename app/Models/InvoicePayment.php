<?php

namespace App\Models;

use App\Traits\Model\HasInvoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicePayment extends Model
{
    use HasFactory, HasInvoice;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'invoice_id',
        'Iinn',
        'Acn',
        'Trmn',
        'Trn',
        'Pcn',
        'Pid',
        'Pdt',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'Pdt' => 'datetime',
     ];
}
