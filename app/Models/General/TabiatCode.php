<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Models\General\TabiatProduct;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Jenssegers\Mongodb\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class TabiatCode extends Model
{
    use Uri, View, Filterable;

    protected $connection = 'mongodb';

    protected $collection = 'tabiat_codes';

    // protected $primaryKey = 'id';

    protected $route_name = 'tabiat_codes';

    protected $guarded = [];

    protected $dates = ['utilization_date'];

    public function getCreatedAtFaAttribute()
    {
        return Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i');
    }

    public function tabiat_product()
    {
        return $this->belongsTo(TabiatProduct::class, 'tabiat_product_id', 'id');
    }

    public function getTabiatProductTitleAttribute()
    {
        return optional($this->tabiat_product)->title ?? '';
    }

    public function getutilizationDateFaAttribute()
    {
        return $this->utilization_date
        ? Jalalian::fromDateTime($this->utilization_date)->format('Y/m/d H:i')
        : null
        ;
    }

    public static function isUsedBefore($note)
    {
        return static::query()
            ->where('code', $note)
            ->where('status', 1)
            ->exists();
    }

    public static function isUsedBeforeBy($note, $member)
    {
        return static::query()
            ->where('code', $note)
            ->where('status', 1)
            ->where('member_id', $member->id)
            ->exists();
    }

    public function getInsertUriAttribute()
    {
        return route($this->getRouteName() . '.insert');
    }

    public function getStatusTitleAttribute()
    {
        return collect(config('portal.tabiat_code.status'))->where('id', $this->status)->first()['name'] ?? '';
    }

    public function makeFree()
    {
        $this->update([
            'status'   => 0,
            'is_freed' => 1,
        ]);

        $this->unset([
            'member_id',
            'utilization_date',
        ]);
    }

    // {{dont_delete_this_comment}}
}
