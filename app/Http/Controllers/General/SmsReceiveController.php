<?php

namespace App\Http\Controllers\General;

use App\Filters\SmsReceiveFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\SmsReceive\SmsReceiveCollection;
use App\Models\General\SmsReceive;
use App\Models\General\TabiatProduct;
use App\Models\General\TabiatProductCategory;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SmsReceiveController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the sms_receive.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, SmsReceiveFilters $filters)
    {
        // return new SmsReceiveCollection(SmsReceive::filter($filters)->simplePaginate(get_per_page($request)));
        if (request()->expectsJson()) {
            return new SmsReceiveCollection(SmsReceive::filter($filters)->simplePaginate(get_per_page($request)));
        }

        $data['options']['status']             = config('portal.sms_receive.status');
        $data['options']['code_state']         = config('portal.sms_receive.code_state');
        $data['options']['products']           = config('portal.sms_receive.code_state');
        $data['options']['products']           = TabiatProduct::latest()->asOption();
        $data['options']['product_categories'] = TabiatProductCategory::asOption();

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new sms_receive.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new SmsReceive,
        ]);
    }

    /**
     * Store a newly created sms_receive in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        SmsReceive::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('sms_receives.index')]);
        }

        return redirect()
            ->route('sms_receives.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified sms_receive.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SmsReceive $sms_receive)
    {
        //
    }

    /**
     * Show the form for editing the specified sms_receive.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SmsReceive $sms_receive)
    {
        return view('admin.globals.edit', [
            'model'     => $sms_receive,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified sms_receive in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SmsReceive $sms_receive)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $sms_receive->update($data);

        success_flash();
        return response(['redirect' => route('sms_receives.index')]);
    }

    /**
     * Remove the specified sms_receive from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmsReceive $sms_receive)
    {
        return response([
            'result' => $sms_receive->delete(),
        ]);
    }

    /**
     * Validate the sms_receive store request.
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
     * Validate the sms_receive update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, SmsReceive $sms_receive)
    {
        return $request->validate([
            //
        ]);
    }

    /**
     * Export as Excel
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Export(Request $request, SmsReceiveFilters $filters)
    {
        ini_set('memory_limit', '8024M');

        $sms_receives = SmsReceive::query()
            ->select(['sender', 'note', 'created_at'])
            ->filter($filters)
            ->orderBy('_id', 'desc')
            ->get();

        $fileName     = 'sms_receives'. '_date_('. date("Y/m/d H:i:s") .')_count_(' . count($sms_receives) .').csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0",
        );

        $columns = array('موبایل', 'متن', 'تاریخ');

        $file = fopen('php://output', 'w');
        fwrite($file, "sep=,\n");

        $callback = function () use ($sms_receives, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($sms_receives as $sms_receive) {
                $row['sender']     = $sms_receive->sender;
                $row['note']       = $sms_receive->note;
                $row['created_at'] = $sms_receive->created_at_fa;

                fputcsv($file, array($row['sender'], $row['note'], $row['created_at']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);

        // $sms_receives = new SmsReceiveCollection(SmsReceive::filter($filters)->orderBy('_id', 'desc')->get());
        // return Excel::download(new SmsReceivesExport($sms_receives), 'sms_receives.xlsx');
    }
}
