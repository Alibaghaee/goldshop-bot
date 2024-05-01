<?php

namespace App\Http\Controllers\General;

use App\Filters\ReportFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Report\ReportCollection;
use App\Jobs\ExportReportFileJob;
use App\Jobs\GenerateReportJob;
use App\Models\General\Report;
use App\Models\General\TabiatProduct;
use App\Models\General\TabiatProductCategory;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the report.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ReportFilters $filters)
    {
        if (request()->expectsJson()) {
            return new ReportCollection(Report::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new report.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chart_types        = config('portal.report.chart_types');
        $sms_status         = config('portal.sms_receive.status');
        $sms_code_state     = config('portal.sms_receive.code_state');
        $product_categories = TabiatProductCategory::asOption();
        $products           = TabiatProduct::asOption();

        return view('admin.globals.create', [
            'model'              => new Report(),
            'chart_types'        => $chart_types,
            'sms_status'         => $sms_status,
            'sms_code_state'     => $sms_code_state,
            'product_categories' => $product_categories,
            'products'           => $products,
        ]);
    }

    /**
     * Store a newly created report in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $report = Report::create($data);

        GenerateReportJob::dispatch($report);
        ExportReportFileJob::dispatch($report)->onQueue('export_file');

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('reports.index')]);
        }

        return redirect()
            ->route('reports.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified report.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        $labels = [];
        $data   = [];

        if (blank($report->result)) {
            return abort(590);
        }

        if ($report->chart_type == 3) {
            foreach ($report->result as $item) {
                $label    = optional(TabiatProduct::where('id', Arr::get($item, '_id.tabiat_product_id'))->first())->title . ' (' . number_format(Arr::get($item, 'count')) . ')';
                $labels[] = $label;
                $data[]   = Arr::get($item, 'count');
            }
        }

        return view('admin.modules.reports.show', compact('report', 'labels', 'data'));
    }

    /**
     * Show the form for editing the specified report.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        $chart_types        = config('portal.report.chart_types');
        $sms_status         = config('portal.sms_receive.status');
        $sms_code_state     = config('portal.sms_receive.code_state');
        $product_categories = TabiatProductCategory::asOption();
        $products           = TabiatProduct::asOption();

        return view('admin.globals.edit', [
            'model'              => $report,
            'edit_form'          => true,
            'chart_types'        => $chart_types,
            'sms_status'         => $sms_status,
            'sms_code_state'     => $sms_code_state,
            'product_categories' => $product_categories,
            'products'           => $products,
        ]);
    }

    /**
     * Update the specified report in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        // validate
        $data = $this->validateStore($request);

        $data['status'] = 0;

        // create
        $report->update($data);

        success_flash();
        return response(['redirect' => route('reports.index')]);
    }

    /**
     * Remove the specified report from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        return response([
            'result' => $report->delete(),
        ]);
    }

    /**
     * Validate the report store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        $data = $request->validate([
            'title'                  => 'required',
            'chart_type.id'          => 'required',
            'note'                   => 'nullable',
            'sms_status'             => 'nullable',
            'sms_code_state'         => 'nullable',
            'product_category_id.id' => 'nullable',
            'product_id.id'          => 'nullable',
            'date_from'              => 'required',
            'date_to'                => 'required',
        ]);

        return multiselect_adapter($data);
    }

    /**
     * Validate the report update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, Report $report)
    {
        return $request->validate([
            //
        ]);
    }

    public function getFile(Report $report)
    {
        abort_if(
            !Storage::disk('files')->exists($report->file),
            404,
            "فایل وجود ندارد، مسیر فایل را بررسی کنید."
        );

        return Storage::disk('files')->download($report->file);
    }
}
