<?php

namespace App\Traits\Seeds;

trait DataFill
{
    public function dataFill($module)
    {
        data_set($module, 'module.created_at', now());
        data_set($module, 'module.updated_at', now());
        data_set($module, 'controllers.*.actions.*.created_at', now());
        data_set($module, 'controllers.*.actions.*.updated_at', now());
        data_set($module, 'controllers.*.actions.*.icon', $this->default_actions_icon, false);

        return $module;
    }
}
