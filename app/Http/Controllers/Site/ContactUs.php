<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\NewProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUs extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        app()->setLocale('en');

        $data = $request->validate([
            'fullname' => 'required|max:255',
            'company'  => 'max:255',
            'email'    => 'required|email|max:255',
            'phone'    => 'max:255',
            'detail'   => 'max:50000',
            'city'     => 'max:255',
            'country'  => 'max:255',
            'file'     => 'file|mimes:pdf,xlsx,xls,doc,docx,jpeg,bmp,png|nullable',
        ]);

        if ($request->has('file')) {
            $file_path = $request->file->store('/files/projects', ['disk' => 'public']);
        } else {
            $file_path = "";
        }

        foreach (config('portal.admins_email') as $email) {
            Mail::to($email)->send(new NewProject($data, $file_path));
        }

        flash_message('Your request has been successfully submitted');
        return back();
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
