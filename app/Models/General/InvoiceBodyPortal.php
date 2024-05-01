<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\UriForItems;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class InvoiceBodyPortal extends Model
{
    use UriForItems, View, Filterable;

    protected $route_name = 'invoice_portals.invoice_body_portals';

    protected $guarded = [];

    public function invoice_portal()
    {
        return $this->belongsTo('App\Models\General\InvoicePortal');
    }
}
