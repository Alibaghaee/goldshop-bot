<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class SelectedCustomer extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'selected_customers';

    protected $guarded = [];

    protected $casts = [
        'shop_purchase_status'    => 'array',
        'shop_available_products' => 'array',
    ];

    public function getCreatedAtFaAttribute()
    {
        return $this->created_at ? Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i:s') : '';
    }

    // {{dont_delete_this_comment}}
}
