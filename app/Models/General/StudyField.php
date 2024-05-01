<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class StudyField extends Model
{
    public static function scopeAsOption($query)
    {
        return $query->select('title as name', 'study_fields.id')->get();
    }
}
