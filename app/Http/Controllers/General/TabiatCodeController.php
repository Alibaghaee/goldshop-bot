<?php

namespace App\Http\Controllers\General;

use App\Filters\TabiatCodeFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\TabiatCode\TabiatCodeCollection;
use App\Models\General\TabiatCode;
use App\Models\General\TabiatProduct;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Facades\Excel;

class TabiatCodeController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the tabiat_code.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, TabiatCodeFilters $filters)
    {
        if (request()->expectsJson()) {
            return new TabiatCodeCollection(TabiatCode::filter($filters)->simplePaginate(get_per_page($request)));
            // return new TabiatCodeCollection(TabiatCode::with('tabiat_product')->filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['status']          = config('portal.tabiat_code.status');
        $data['options']['tabiat_products'] = TabiatProduct::latest()->asOption();

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new tabiat_code.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model'           => new TabiatCode,
            'tabiat_products' => TabiatProduct::latest()->asOption(),
        ]);
    }

    /**
     * Store a newly created tabiat_code in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        $generated_codes = $this->generateCodes($data);
        // dd($generated_codes);

        // create
        TabiatCode::insert($generated_codes);

        success_flash();
        return response(['redirect' => route('tabiat_codes.index')]);
    }

    /**
     * Display the specified tabiat_code.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TabiatCode $tabiat_code)
    {
        //
    }

    /**
     * Show the form for editing the specified tabiat_code.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TabiatCode $tabiat_code)
    {
        return view('admin.globals.edit', [
            'model'     => $tabiat_code,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified tabiat_code in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TabiatCode $tabiat_code)
    {
        // validate
        $data = $this->validateUpdate($request, $tabiat_code);

        if ($request->free_code == true) {
            $tabiat_code->makeFree();
        }

        // create
        // $tabiat_code->update($data);

        success_flash();
        return response(['redirect' => route('tabiat_codes.index')]);
    }

    /**
     * Remove the specified tabiat_code from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TabiatCode $tabiat_code)
    {
        return response([
            'result' => $tabiat_code->delete(),
        ]);
    }

    /**
     * Validate the tabiat_code store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        $data = $request->validate([
            'tabiat_product_id.id' => 'required|exists:mongodb.tabiat_product,id',
            'count'                => 'required|integer|max:50000',
            'length'               => 'required|integer|max:25',
        ]);

        $data = multiselect_adapter($data);

        return $data;
    }

    /**
     * Validate the tabiat_code update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, TabiatCode $tabiat_code)
    {
        return $request->validate([
            'free_code' => 'boolean',
        ]);
    }

    protected function generateCodes($data)
    {
        $tabiat_product_id = Arr::get($data, 'tabiat_product_id');
        $count             = Arr::get($data, 'count');
        $length            = Arr::get($data, 'length');

        $codes = UniqueRandomNumbersWithinRange(pow(10, $length - 1), pow(10, $length) - 1, $count);

        $exists_code = TabiatCode::select('code')->whereIn('code', $codes)->pluck('code')->toArray();

        $valid_codes = array_diff($codes, $exists_code);

        $insert_data = collect($valid_codes)->map(function ($item) use ($tabiat_product_id) {
            return [
                'code'              => (string) $item,
                'tabiat_product_id' => $tabiat_product_id,
                'refrence_id'       => null,
                'status'            => 0,
                'created_at'        => mongoNow(),
                'updated_at'        => mongoNow(),
            ];
        })->toArray();

        return $insert_data;
    }

    /**
     * Show the form for creating a new tabiat_code.
     *
     * @return \Illuminate\Http\Response
     */
    public function insertForm()
    {
        return view('admin.modules.tabiat_codes.insert', [
            'model'           => new TabiatCode,
            'tabiat_products' => TabiatProduct::latest()->asOption(),
        ]);
    }

    /**
     * Store a newly created tabiat_code in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        $data              = $this->validateInsert($request);
        $tabiat_product_id = Arr::get($data, 'tabiat_product_id');
        $codes             = Arr::get($data, 'codes');
        $codes_array       = array_values((array_filter(explode(PHP_EOL, $codes))));

        $insert_data = collect($codes_array)->map(function ($code) use ($tabiat_product_id) {
            return [
                'code'              => (string) $code,
                'tabiat_product_id' => $tabiat_product_id,
                'refrence_id'       => null,
                'status'            => 0,
                'created_by'        => auth()->id(),
                'created_at'        => mongoNow(),
                'updated_at'        => mongoNow(),
            ];
        })->toArray();

        TabiatCode::insert($insert_data);

        success_flash();
        return response(['redirect' => route('tabiat_codes.index')]);
    }

    /**
     * Validate the tabiat_code store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateInsert(Request $request)
    {
        $data = $request->validate([
            'tabiat_product_id.id' => 'required|exists:mongodb.tabiat_product,id',
            'codes'                => 'required|string',
        ]);

        $data = multiselect_adapter($data);

        return $data;
    }

    /**
     * Export as Excel
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request, TabiatCodeFilters $filters)
    {
        ini_set('memory_limit', '8024M');

        $codes = TabiatCode::query()
            ->select(['code', 'tabiat_product_id', 'utilization_date'])
            ->filter($filters)
            ->orderBy('_id', 'desc')
            ->take(200000)
            ->get();

        $fileName = 'codes' . '_' . count($codes) . '.csv';

        $headers = array(
            "Content-type"        => "text/csv; charset=utf-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0",
        );

        $columns = array("code", "utilization date");
        // $columns = array('کد', 'تااریخ استفاده', 'عنوان محصول');

        $file = fopen('php://output', 'w');
        fwrite($file, "sep=,\n");

        $callback = function () use ($codes, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($codes as $code) {
                $row['code'] = $code->code;
                // $row['tabiat_product_title'] = $code->tabiat_product_title;
                $row['utilization_date'] = $code->utilization_date_fa;

                // fputcsv($file, array($row['code'], $row['tabiat_product_title'], $row['utilization_date']));
                fputcsv($file, array($row['code'], $row['utilization_date']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);

        // $codes = new TabiatCodeCollection(TabiatCode::filter($filters)->orderBy('_id', 'desc')->get());
        // return Excel::download(new TabiatCodesExport($codes), 'codes.xlsx');
    }
}
