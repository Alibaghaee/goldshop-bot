<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\Profile;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use AdminGuard;

    /**
     * Show the form for editing the specified profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $profile = Profile::findOrFail(auth()->id());

        return view('admin.globals.edit', [
            'model'     => $profile,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified profile in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $profile = auth()->user();

        // validate
        $data = $this->validateUpdate($request, $profile);

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        // create
        $profile->update($data);

        success_flash();
        return response(['redirect' => route('profiles.edit', ['x'])]);
    }

    /**
     * Validate the profile update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, $profile)
    {
        return $request->validate([
            'name'     => 'required|max:255',
            'family'   => 'required|max:255',
            'email'    => "required|email|unique:admins,email,$profile->id,id",
            'password' => 'confirmed|max:255',
            'address'  => 'nullable|string|max:1000',
            'mobile'   => 'nullable|numeric',
            'phone'    => 'nullable|numeric',
            'avatar'   => 'nullable|string',
            'numbers'  => 'nullable|string',
        ]);
    }
}
