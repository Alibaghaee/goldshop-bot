<?php

namespace App\Http\Controllers\General;

use App\Filters\LotteryOneFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\LotteryOne\LotteryOneCollection;
use App\Jobs\ExportLotteryOneJob;
use App\Models\General\LotteryOne;
use App\Models\General\LotteryZojino;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LotteryOneController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the lottery_one.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, LotteryOneFilters $filters)
    {
        if (request()->expectsJson()) {
            return new LotteryOneCollection(LotteryOne::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new lottery_one.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new LotteryOne,
        ]);
    }

    /**
     * Store a newly created lottery_one in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $lottery_one = LotteryOne::create($data);

        ExportLotteryOneJob::dispatch($lottery_one)->onQueue('export_file');

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('lottery_ones.index')]);
        }

        return redirect()
            ->route('lottery_ones.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified lottery_one.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(LotteryOne $lottery_one)
    {
        return view('admin.modules.lottery_ones.show', [
            'lottery' => $lottery_one,
        ]);
    }

    /**
     * Show the form for editing the specified lottery_one.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(LotteryOne $lottery_one)
    {
        return view('admin.globals.edit', [
            'model'     => $lottery_one,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified lottery_one in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LotteryOne $lottery_one)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $lottery_one->update($data);

        success_flash();
        return response(['redirect' => route('lottery_ones.index')]);
    }

    /**
     * Remove the specified lottery_one from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LotteryOne $lottery_one)
    {
        return response([
            'result' => $lottery_one->delete(),
        ]);
    }

    /**
     * Validate the lottery_one store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'title' => 'required|max:255',
            'step'  => 'required|max:255',
            'date'  => 'required|date',
        ]);
    }

    /**
     * Validate the lottery_one update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, LotteryOne $lottery_one)
    {
        return $request->validate([
            //
        ]);
    }

    public function runLottery(Request $request, LotteryOne $lottery_one)
    {
        $winner = LotteryZojino::query()
            ->inDate($lottery_one->date)
            ->where('total_id', intval($request->winner_id))
            ->first();

        $lottery_one->update([
            'winner_data' => $winner->only(['mobile', 'code', 'total_id']),
        ]);

        return $winner;
    }

    public function getFile(LotteryOne $lottery_one)
    {
        abort_if(
            !Storage::disk('files')->exists($lottery_one->file),
            404,
            "فایل وجود ندارد، مسیر فایل را بررسی کنید."
        );

        return Storage::disk('files')->download($lottery_one->file);
    }
}
