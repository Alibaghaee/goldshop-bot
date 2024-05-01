<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\General\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transportation_type = config('portal.transportation_type');

        return view(getSiteBladePath('modules.order.create'), compact('transportation_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'request_info'           => 'required|max:10000',
            'product_type'           => 'required|max:255',
            'packing_type'           => 'required|max:255',
            'weight'                 => 'required|max:255',
            'volume'                 => 'required|max:255',
            'origin'                 => 'required|max:255',
            'destination'            => 'required|max:255',
            'preparation_time'       => 'required|max:255',
            'transportation_type.id' => 'required|in:1,2,3,4',
            'captcha'                => 'required|captcha',
            'fullname'               => 'required|max:255',
            'mobile'                 => 'required|regex:/^09[0-9]{9}$/i',
        ]);

        $data = multiselect_adapter($data);
        unset($data['captcha']);

        Order::create($data);

        success_flash('ثبت درخواست با موفقیت انجام شد.');
        return response(['redirect' => '/' . app()->getLocale()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
