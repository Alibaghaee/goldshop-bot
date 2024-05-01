<?php

namespace App\Http\Controllers\General;

use App\Filters\ExpertAttendanceDaysFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExpertAttendanceDays\ExpertAttendanceDaysCollection;
use App\Models\General\Expert;
use App\Models\General\ExpertAttendanceDays;
use App\Models\General\Room;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class ExpertAttendanceDaysController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the expert_attendance_days.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ExpertAttendanceDaysFilters $filters)
    {
        if (request()->expectsJson()) {
            return new ExpertAttendanceDaysCollection(ExpertAttendanceDays::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new expert_attendance_days.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $experts = Expert::asOption();
        $rooms   = Room::asOption();

        return view('admin.globals.create', [
            'model'   => new ExpertAttendanceDays,
            'experts' => $experts,
            'rooms'   => $rooms,
        ]);
    }

    /**
     * Store a newly created expert_attendance_days in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        ExpertAttendanceDays::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('expert_attendance_days.index')]);
        }

        return redirect()
            ->route('expert_attendance_days.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified expert_attendance_days.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ExpertAttendanceDays $expert_attendance_days)
    {
        //
    }

    /**
     * Show the form for editing the specified expert_attendance_days.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpertAttendanceDays $expert_attendance_days)
    {
        return view('admin.globals.edit', [
            'model'     => $expert_attendance_days,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified expert_attendance_days in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpertAttendanceDays $expert_attendance_days)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $expert_attendance_days->update($data);

        success_flash();
        return response(['redirect' => route('expert_attendance_days.index')]);
    }

    /**
     * Remove the specified expert_attendance_days from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpertAttendanceDays $expert_attendance_days)
    {
        return response([
            'result' => $expert_attendance_days->delete(),
        ]);
    }

    /**
     * Validate the expert_attendance_days store request.
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
     * Validate the expert_attendance_days update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, ExpertAttendanceDays $expert_attendance_days)
    {
        return $request->validate([
            //
        ]);
    }
}
