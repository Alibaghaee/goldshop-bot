<?php

namespace App\Models;

use App\Traits\Model\HasInvoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceBody extends Model
{
    use HasFactory, HasInvoice;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'invoice_id',
        'Sstid',
        'Sstt',
        'Mu',
        'Am',
        'Fee',
        'Cfee',
        'Cut',
        'Exr',
        'Prdis',
        'Dis',
        'Adis',
        'Vra',
        'Vam',
        'Odt',
        'Odr',
        'Odam',
        'Olt',
        'Olr',
        'Olam',
        'Consfee',
        'Spro',
        'Bros',
        'Tcpbs',
        'Cop',
        'Bsrn',
        'Vop',
        'Tsstam',
    ];


}
