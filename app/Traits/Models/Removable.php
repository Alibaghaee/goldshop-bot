<?php

namespace App\Traits\Models;

trait Removable
{
    public function remove()
    {
        if ($this->removable) {
            return $this->delete();
        }
        return false;
    }
}
