<?php

namespace App\ModelsScope\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class DomainScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        // return $builder->where('domain_id', request()->domain_id());
        return $builder;
    }
}
