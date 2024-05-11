<?php

namespace App\ModelsScope\Traits;

use App\ModelsScope\Scopes\DomainScope;

trait DomainScopeTrait
{
    protected static function bootDomainScopeTrait()
    {
        static::addGlobalScope(new DomainScope());
        if (request()->domain_id()){

            static::creating(function ($model) {
                $model->setAttribute('domain_id', request()->domain_id());
            });
        }
    }
}
