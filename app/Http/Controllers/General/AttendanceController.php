<?php

namespace App\Http\Controllers\General;

use App\Filters\AttendanceFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Attendance\AttendanceCollection;
use App\Models\General\Admin;
use App\Models\General\Attendance;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the attendance.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, AttendanceFilters $filters)
    {
        if (request()->expectsJson()) {
            return new AttendanceCollection(Attendance::filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['admins'] = Admin::asOption();

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new attendance.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new Attendance,
        ]);
    }

    /**
     * Store a newly created attendance in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        Attendance::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('attendances.index')]);
        }

        return redirect()
            ->route('attendances.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified attendance.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified attendance.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        return view('admin.globals.edit', [
            'model'     => $attendance,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified attendance in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $attendance->update($data);

        success_flash();
        return response(['redirect' => route('attendances.index')]);
    }

    /**
     * Remove the specified attendance from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        return response([
            'result' => $attendance->delete(),
        ]);
    }

    /**
     * Validate the attendance store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            //
        ]);
    }

    /**
     * Validate the attendance update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, Attendance $attendance)
    {
        return $request->validate([
            //
        ]);
    }
}
