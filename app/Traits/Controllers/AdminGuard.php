<?php

namespace App\Traits\Controllers;

use Illuminate\Support\Facades\Auth;

trait AdminGuard
{
    /**
     * Get the guard to be used in controller.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
