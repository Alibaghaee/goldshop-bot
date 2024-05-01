<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class InvoicePortal extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'invoice_portals';

    protected $guarded = [];

    public static $intyList = [
        ['id' => 1, 'name' => 'نوع اول'],
        ['id' => 2, 'name' => 'نوع دوم'],
        ['id' => 3, 'name' => 'نوع سوم'],
    ];

    public static $tobList = [
        ['id' => 1, 'name' => 'حقیقی'],
        ['id' => 2, 'name' => 'حقوقی'],
        ['id' => 3, 'name' => ' مشاركت مدنی'],
        ['id' => 4, 'name' => 'اتباع غیر ایرانی'],
        ['id' => 5, 'name' => 'مصرف كننده نهایی'],
    ];

    public static $patternList = [
        ['id' => 1, 'name' => 'فروش کالا/خدمات'],
        ['id' => 2, 'name' => 'فروش ارزی'],
        ['id' => 3, 'name' => 'فروش طلا و جواهر'],
        ['id' => 4, 'name' => 'قرارداد پیمانکاری'],
    ];

    public static $subjectList = [
        ['id' => 1, 'name' => 'اصلی فروش'],
        ['id' => 2, 'name' => 'اصلاحی'],
        ['id' => 3, 'name' => 'ابطالی'],
        ['id' => 4, 'name' => 'برگشت از فروش'],
    ];

    public static $settlementMethodList = [
        ['id' => 1, 'name' => 'نقدی'],
        ['id' => 2, 'name' => 'نسیه'],
        ['id' => 3, 'name' => 'نقدی/نسیه'],
    ];
    protected $appends = ['index_uri', 'item_create_uri'];

    public function items()
    {
        return $this->hasMany('App\Models\General\InvoiceBodyPortal');
    }

    public function getItemsUriAttribute()
    {
        return route('invoice_portals.invoice_body_portals.index', ['invoice_portal' => $this->id]);
    }

    public function getItemCreateUriAttribute()
    {
        return route('invoice_portals.invoice_body_portals.create', ['invoice_portal' => $this->id]);
    }

}
