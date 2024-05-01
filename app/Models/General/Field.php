<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Models\General\Category;
use App\Models\General\Form;
use App\Models\General\Rule;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'fields';

    protected $guarded = [];

    public function forms()
    {
        return $this->belongsToMany(Form::class);
    }

    public function rules()
    {
        return $this->belongsToMany(Rule::class);
    }

    public static function scopeAsOption($query)
    {
        return $query->select('fields.id', 'label as name')->get();
    }

    public function getTypeTitleAttribute()
    {
        return collect(config('portal.form.field_types'))->where('id', $this->type)->first()['name'];
    }

    public function getRulesArrayAttribute()
    {
        $rules = [];
        foreach ($this->rules as $rule) {
            $rule_definition = $rule->rule;
            $rules[]         = $rule->class ? new $rule_definition() : $rule_definition;
        }
        return $rules;
    }

    public function getValidationKeyName()
    {
        return $this->type == 3 ? $this->name . '.id' : $this->name;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getOptions()
    {
        return $this->type == 3 ? optional(optional($this->category)->items())->asOptionBykey() : [];
    }

    // {{dont_delete_this_comment}}
}
