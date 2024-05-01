<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\General\Menu;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faq = Menu::getMenu(localeMenuId(19));

        return view(getSiteBladePath('modules.faq.index'), compact('faq'));
    }
}
