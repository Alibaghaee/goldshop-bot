<?php

namespace App\Http\Middleware;

use App\Models\General\Attendance;
use Carbon\Carbon;
use Closure;

class AttendanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (request()->ip() == setting(1) && auth()->id() != 1) {
            $this->createOrUpdateAttendance();
        }

        return $next($request);
    }

    private function createOrUpdateAttendance()
    {
        if ($attendance = $this->todayHasAttendance()) {
            $this->updateAttendance($attendance);
        } else {
            $this->createNewAttendance();
        }
    }

    private function todayHasAttendance()
    {
        $startDay = Carbon::now()->startOfDay();
        $endDay   = $startDay->copy()->endOfDay();

        return Attendance::whereDate('created_at', '>=', $startDay)
            ->whereDate('created_at', '<=', $endDay)->first();
    }

    private function createNewAttendance()
    {
        auth()->user()->attendances()->create([
            'entry_date'          => Carbon::now(),
            'arranged_enter_time' => auth()->user()->enter_time,
            'arranged_exit_time'  => auth()->user()->exit_time,
        ]);
    }

    private function updateAttendance(Attendance $attendance)
    {
        $attendance->update(['exit_date' => Carbon::now()]);
    }
}
