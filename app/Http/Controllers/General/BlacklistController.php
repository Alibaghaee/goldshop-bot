<?php

namespace App\Http\Controllers\General;

use App\Blacklist\BlacklistManager;
use App\Filters\BlacklistFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Blacklist\BlacklistCollection;
use App\Models\General\Blacklist;
use App\Models\General\BlacklistSendLog;
use App\Rahco\Call\Avanak;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class BlacklistController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the blacklist.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, BlacklistFilters $filters)
    {
        if (request()->expectsJson()) {
            return $this->blacklistList($request, $filters);
        }

        $data['options']['blacklist_type'] = config('portal.blacklist_types');
        $data['options']['status']         = config('portal.blacklist_status');
        $blacklist_send_options            = json_encode(config('portal.blacklist_send_options'));
        $statistics                        = $this->statistics();

        return view('admin.modules.blacklists.index', compact('data', 'blacklist_send_options', 'statistics'));
    }

    /**
     * Show the form for editing the specified department.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blacklist $blacklist)
    {
        $blacklist->update(['status' => 1]);
    }

    /**
     * Update the specified blacklist in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blacklist $blacklist)
    {
        $data    = $this->validateUpdate($request);
        $manager = new BlacklistManager($blacklist, $data);

        return $manager->handle();
    }

    /**
     * Get all sended blacklist numbers list
     * These numbers are read directly from within the database
     * They will not be available after archiving proceess
     * @param  App\Models\General\Blacklist $blacklist
     * @return string
     */
    function list(Blacklist $blacklist) {
        $numbers = $blacklist->sendedBlacklistNumbers();

        return view('admin/modules/blacklists/list', compact('numbers'));
    }

    /**
     * Get sended blacklist numbers list (partial)
     * These numbers are written in the file
     * These numbers will be permanently available unless the related files are deleted
     * @param  Request $request
     * @return
     */
    public function export(Request $request)
    {
        $filepath = implode('/', ['exports', $request->blacklist, $request->filename]);

        if (Storage::has($filepath)) {
            $numbers = Storage::get($filepath);
            return view('admin/modules/blacklists/list', compact('numbers'));
        }

        return abort(404);
    }

    public function sms(Blacklist $blacklist)
    {
        $message = "کاربر گرامی " . $blacklist->user->fullname . "\n\nبا توجه به متن ارسالی شما، از میان " . $blacklist->messages_blacklist_count . " دریافت کننده پیامک خدماتی، " . $blacklist->sendable_count . " دریافت کننده به دلیل کمبود موجودی موفق به دریافت پیامک نشده اند.\n\nموجودی مورد نیاز برای ارسال پیامک های خدماتی باقی مانده " . number_format($blacklist->lack_of_cash) . " ریال می باشد.\n\nدر صورت لزوم لطفا نسبت به شارژ پنل خود اقدام نمایید.";

        $numbers = mobile_alias($blacklist->user->mobile);

        $blacklist->setSmsCache();

        sms(implode(',', $numbers), $message);
    }

    public function call(Blacklist $blacklist)
    {
        $numbers = mobile_alias($blacklist->user->mobile);

        return (new Avanak)->sendBatchCallRequest(
            $numbers,
            config('portal.cash_notify_voice_id')
        );
    }

    /**
     * Validate the blacklist update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request)
    {
        return $request->validate([
            'sender.id'          => 'required|in:1,2,3,4,5,6',
            'note'               => 'required',
            'use_new_note_parts' => 'boolean',
        ]);
    }

    protected function blacklistList(Request $request, BlacklistFilters $filters)
    {
        return new BlacklistCollection(Blacklist::with(['admin', 'user', 'staff'])
                ->customStatusOrder()
                ->orderBy('date', 'desc')
                ->filter($filters)
                ->paginate(get_per_page($request)));
    }

    protected function statistics()
    {
        return [
            'today_total_note_parts'        => BlacklistSendLog::todayTotalNoteParts(),
            'today_reffer_note_parts'       => BlacklistSendLog::todayRefferNoteParts(),
            'today_export_note_parts'       => BlacklistSendLog::todayExportNoteParts(),
            'today_receivers_count'         => BlacklistSendLog::todayReceiversCount(),
            'today_reffer_receivers_count'  => BlacklistSendLog::todayRefferReceiversCount(),
            'today_export_receivers_count'  => BlacklistSendLog::todayExportReceiversCount(),
            // 'total_queue_note_parts'        => Blacklist::totalQueueNoteParts(),
            // 'total_lack_of_cash_note_parts' => Blacklist::totalLackOfCashNoteParts(),
            'total_queue_note_parts'        => 0,
            'total_lack_of_cash_note_parts' => 0,
        ];
    }

}
