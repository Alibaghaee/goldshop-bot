<?php

namespace App\Http\Controllers\General;

use App\Filters\BlacklistSendLogFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlacklistSendLog\BlacklistSendLogCollection;
use App\Models\General\BlacklistSendLog;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class BlacklistSendLogController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the blacklist_send_log.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, BlacklistSendLogFilters $filters)
    {
        if (request()->expectsJson()) {
            return new BlacklistSendLogCollection(BlacklistSendLog::with(['admin'])->filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }
}
