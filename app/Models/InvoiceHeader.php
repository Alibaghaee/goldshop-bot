<?php

namespace App\Models;

use App\Traits\Model\HasInvoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceHeader extends Model
{
    use HasFactory, HasInvoice;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'invoice_id',
        'Indati2m',
        'Indatim',
        'Inty',
        'Ft',
        'Inno',
        'Irtaxid',
        'Scln',
        'Setm',
        'Tins',
        'Cap',
        'Bid',
        'Insp',
        'Tvop',
        'Bpc',
        'Tax17',
        'Inp',
        'Scc',
        'Ins',
        'Billid',
        'Tprdis',
        'Tdis',
        'Tadis',
        'Tvam',
        'Todam',
        'Tbill',
        'Tob',
        'Tinb',
        'Sbc',
        'Bbc',
        'Bpn',
        'Crn',
        'dpvb',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'Indati2m' => 'datetime',
        'Indatim' => 'datetime',
    ];
    public static $tobList = [
        ['id' => 1, 'name' => 'حقیقی'],
        ['id' => 2, 'name' => 'حقوقی'],
        ['id' => 3, 'name' => ' مشاركت مدنی'],
        ['id' => 4, 'name' => 'اتباع غیر ایرانی'],
        ['id' => 5, 'name' => 'مصرف كننده نهایی'],
    ];


    public static $ftList = [
        ['id' => 1, 'name' => 'داخلی'],
        ['id' => 2, 'name' => 'خارجی'],
    ];


    public static $setmList = [
        ['id' => 1, 'name' => 'نقد'],
        ['id' => 2, 'name' => 'نسیه'],
        ['id' => 3, 'name' => 'نقد/نسیه'],
    ];


    public static $dpvbList = [
        ['id' => 1, 'name' => 'عدم پرداخت'],
        ['id' => 2, 'name' => 'پرداخت'],
    ];


    public static $intyList = [
        ['id' => 1, 'name' => 'نوع اول'],
        ['id' => 2, 'name' => 'نوع دوم'],
        ['id' => 3, 'name' => 'نوع سوم'],
    ];

}
