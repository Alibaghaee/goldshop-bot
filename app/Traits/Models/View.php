<?php

namespace App\Traits\Models;

trait View
{
    public function getModuleName()
    {
        return snake_case(str_plural($this->module_name ?: class_basename($this)));
    }

    public function getFormCreatePathAttribute()
    {
        return 'admin.modules.' . $this->getModuleName() . '.form_create';
    }

    public function getFormEditPathAttribute()
    {
        return 'admin.modules.' . $this->getModuleName() . '.form_edit';
    }

}
