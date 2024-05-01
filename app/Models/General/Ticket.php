<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Morilog\Jalali\Jalalian;

class Ticket extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'tickets';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('owner', function (Builder $builder) {
            $builder->where('creator_id', auth()->id())->orWhere('receiver_id', auth()->id());
        });
    }

    public function creator()
    {
        return $this->belongsTo('App\Models\General\Admin', 'creator_id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Models\General\Admin', 'receiver_id');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\General\Ticket');
    }

    public function getCreatedAtFaAttribute()
    {
        return Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i');
    }

    public function getUpdatedAtFaAttribute()
    {
        return Jalalian::fromCarbon($this->updated_at)->format('Y/m/d H:i');
    }

    protected $appends = ['index_uri', 'item_create_uri'];

    public function items()
    {
        return $this->hasMany('App\Models\General\Answer')->latest();
    }

    public function getItemsUriAttribute()
    {
        return route('tickets.answers.index', ['ticket' => $this->id]);
    }

    public function getItemCreateUriAttribute()
    {
        return route('tickets.answers.create', ['ticket' => $this->id]);
    }

    public function scopeIsTicket($query)
    {
        return $query->whereNull('ticket_id');
    }

    public function getStatusTitleAttribute()
    {
        return Arr::get(Arr::get(config('portal.ticket_status'), $this->status, ''), 'name');
    }

    public function responsed()
    {
        $status = $this->creator_id == auth()->id() ? 2 : 1;
        $this->update(['status' => $status]);
    }

}
