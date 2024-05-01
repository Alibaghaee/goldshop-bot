<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


class DashboardController extends Controller
{


    public function index()
    {



        return view('site.module.dashboard.dashboard');
    }
}
