<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Arr;

class Pay extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'pays';

    protected $guarded = [];

    protected $appends = ['fullname', 'created_at_fa', 'payed_title', 'gender_title', 'grade_title', 'field_of_study_title', 'payment_subject_title'];

    public function getFullnameAttribute()
    {
        return $this->name . ' ' . $this->family;
    }

    public function getCreatedAtFaAttribute()
    {
        return Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i');
    }

    public function scopePayed($query)
    {
        return $query->where('payed', true);
    }

    public function getPayedTitleAttribute()
    {
        return $this->payed == true ? 'موفق' : 'ناموفق';
    }

    public function province()
    {
        return $this->belongsTo('App\Models\General\Province');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\General\City');
    }

    public function getGenderTitleAttribute()
    {
        return Arr::get(collect(config('portal.genders'))->firstWhere('id', $this->gender), 'name');
    }

    public function getUpdatedAtFaAttribute()
    {
        return Jalalian::fromDateTime($this->updated_at)->format('Y/m/d H:i');
    }

    public static function scopeAsOption($query)
    {
        return $query->select('id', \DB::raw("CONCAT(name, ' ', family, ' - کد ملی: ', national_code) as name"))->get();
    }

    public function getGradeTitleAttribute()
    {
        return Arr::get(collect(config('portal.grades'))->firstWhere('id', $this->grade), 'name');
    }

    public function getFieldOfStudyTitleAttribute()
    {
        return Arr::get(collect(config('portal.fields_of_study'))->firstWhere('id', $this->field_of_study), 'name');
    }

    public function getPaymentSubjectTitleAttribute()
    {
        return Arr::get(collect(config('portal.payment_subjects'))->firstWhere('id', $this->payment_subject), 'name');
    }

    public function getFullnamePrependAttribute()
    {
        if ($this->gender == 0) {
            return 'خانم';
        }
        return 'آقای';
    }

    // {{dont_delete_this_comment}}
}
