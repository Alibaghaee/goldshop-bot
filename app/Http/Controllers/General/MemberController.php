<?php

namespace App\Http\Controllers\General;

use App\Filters\MemberFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Member\MemberCollection;
use App\Models\General\City;
use App\Models\General\Member;
use App\Models\General\Province;
use App\Rules\Mobile;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the member.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, MemberFilters $filters)
    {
        if (request()->expectsJson()) {
            return new MemberCollection(Member::filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['provinces'] = Province::asOption();
        $data['options']['cities']    = City::asOption();

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new member.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new Member,
        ]);
    }

    /**
     * Store a newly created member in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        Member::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('members.index')]);
        }

        return redirect()
            ->route('members.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified member.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified member.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view('admin.globals.edit', [
            'model'     => $member,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified member in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $member->update($data);

        success_flash();
        return response(['redirect' => route('members.index')]);
    }

    /**
     * Remove the specified member from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        return response([
            'result' => $member->delete(),
        ]);
    }

    /**
     * Validate the member store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|max:255',
            'family'         => 'required|max:255',
            'mobile'         => ['nullable', new Mobile],
            'province_id.id' => 'nullable|exists:provinces,id',
            'city_id.id'     => 'nullable|exists:cities,id',
            'birth_date'     => 'nullable|date',
            'complete'       => 'nullable|boolean',
            'blacklist'      => 'nullable|boolean',
        ]);

        $data = multiselect_adapter($data);

        return $data;
    }

    /**
     * Validate the member update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, Member $member)
    {
        return $request->validate([
            //
        ]);
    }
}
