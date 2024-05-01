<?php

namespace App\ModelsScope\Traits;

use App\ModelsScope\Scopes\DomainScope;

trait DomainScopeTrait
{
    protected static function bootDomainScopeTrait()
    {
        static::addGlobalScope(new DomainScope());

        static::creating(function ($model) {
            $model->setAttribute('domain_id', request()->domain_id());
        });
    }
}
