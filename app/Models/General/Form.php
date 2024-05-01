<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Models\General\Field;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'forms';

    protected $guarded = [];

    public static function scopeAsOption($query)
    {
        return $query->select('forms.id', 'title as name')->get();
    }

    public function fields()
    {
        return $this->belongsToMany(Field::class)->orderBy('field_form.id');
    }

    public function getFieldsNameAttribute()
    {
        $result = $this->fields->pluck('name')->toArray();

        if (in_array('province_id', $result)) {
            $result = array_merge($result, ['city_id']);
        }
        return $result;
    }

    public function getUserUncompleteFieldsNameAttribute()
    {
        $result = $this->userUncompleteFields->pluck('name')->toArray();

        if (in_array('province_id', $result)) {
            $result = array_merge($result, ['city_id']);
        }
        return $result;
    }

    public function getFieldsIdAttribute()
    {
        return static::fields()->whereIn('name', $this->fields_name)->pluck('fields.id');
    }

    public function getUserUncompleteFieldsIdAttribute()
    {
        return static::userUncompleteFields()->whereIn('name', $this->fields_name)->pluck('fields.id');
    }

    public function getValidationRulesAttribute()
    {
        $validation_rules = $this->necessaryValidationRules();

        foreach ($this->fields as $field) {
            if ($field->name == 'province_id') {
                $validation_rules = array_merge($validation_rules, [
                    'province_id.id' => 'required|exists:provinces,id',
                    'city_id.id'     => 'required|exists:cities,id',
                ]);
            } else {
                $validation_rules[$field->getValidationKeyName()] = $field->rules_array;
            }
        }

        return $validation_rules;
    }

    public function getUncompleteFieldsValidationRulesAttribute()
    {
        $validation_rules = $this->necessaryValidationRules();

        foreach ($this->userUncompleteFields as $field) {
            if ($field->name == 'province_id') {
                $validation_rules = array_merge($validation_rules, [
                    'province_id.id' => 'required|exists:provinces,id',
                    'city_id.id'     => 'required|exists:cities,id',
                ]);
            } else {
                $validation_rules[$field->getValidationKeyName()] = $field->rules_array;
            }
        }

        return $validation_rules;
    }

    private function necessaryValidationRules()
    {
        return [
            'payment_type'  => 'required|in:1,2,3',
            'discount_code' => ['nullable', new \App\Rules\DiscountCodeRule],
        ];
    }

    public function userUncompleteFields()
    {
        $uncomplete_fields_id = auth()->user()->uncompleteFields($this)->pluck('id')->toArray();

        return $this->belongsToMany(Field::class)->orderBy('field_form.id')
            ->whereIn('fields.id', $uncomplete_fields_id);
    }

    // {{dont_delete_this_comment}}
}
