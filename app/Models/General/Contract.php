<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'contracts';

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo('App\Models\General\Customer');
    }

    public function scopeAsOption($query)
    {
        return $query->select('id', 'title as name')->get();
    }

    public function scopeIsPattern($query)
    {
        return $query->where('is_pattern', true);
    }

    public function getExportUrlAttribute()
    {
        return '/contracts/contracts/export/' . $this->id;
    }

    public function getBodyTagReplacedAttribute()
    {
        return $this->replaceTags($this->body);
    }

    private function replaceTags($body)
    {
        $taggable = $this->customer->only([
            'name',
            'family',
            'father_name',
            'id_number',
            'national_code',
            'birth_date',
            'address',
            'postal_code',
            'email',
            'phone',
            'mobile',
            'fax',
            'site',
            'company_name',
            'economic_code',
            'company_national_code',
            'register_id',
            'place',
        ]);

        $taggable['birth_date'] = $this->customer->birth_date_fa;

        $alias = [
            '#نام_مشتری'          => '#name',
            '#نام_خانوادگی_مشتری' => '#family',
            '#نام_پدر'            => '#father_name',
            '#شماره_شناسنامه'     => '#id_number',
            '#کد_ملی'             => '#national_code',
            '#تاریخ_تولد'         => '#birth_date',
            '#محل_تولد'           => '#place',
            '#آدرس'               => '#address',
            '#کد_پستی'            => '#postal_code',
            '#ایمیل'              => '#email',
            '#تلفن'               => '#phone',
            '#موبایل'             => '#mobile',
            '#فکس'                => '#fax',
            '#اسیت'                => '#site',
            '#نام_شرکت'           => '#company_name',
            '#کد_اقتصادی'         => '#economic_code',
            '#شناسه_ملی_شرکت'     => '#company_national_code',
            '#شناسه_ثبت'          => '#register_id',
        ];

        foreach ($alias as $fa_tag => $en_tag) {
            $body = str_ireplace($fa_tag, $en_tag, $body);
        }
        foreach ($taggable as $tag => $value) {
            $body = str_ireplace("#$tag", $value, $body);
        }

        return $body;
    }

    // {{dont_delete_this_comment}}
}
