<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\UriForItems;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Answer extends Model
{
    use UriForItems, View, Filterable;

    protected $route_name = 'tickets.answers';

    protected $table = 'tickets';

    protected $guarded = [];

    public function ticket()
    {
        return $this->belongsTo('App\Models\General\Ticket');
    }

    public function creator()
    {
        return $this->belongsTo('App\Models\General\Admin', 'creator_id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Models\General\Admin', 'receiver_id');
    }

    public function getCreatedAtFaAttribute()
    {
        return Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i');
    }

    public function getUpdatedAtFaAttribute()
    {
        return Jalalian::fromCarbon($this->updated_at)->format('Y/m/d H:i');
    }

    public function getIsOwnerAttribute()
    {
        return $this->creator_id == auth()->id();
    }
}
