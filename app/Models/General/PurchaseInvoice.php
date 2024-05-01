<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class PurchaseInvoice extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'purchase_invoices';

    protected $guarded = [];

    public function getCreatedAtFaAttribute()
    {
        return Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i');
    }

    // {{dont_delete_this_comment}}
}
