<?php

namespace App\Http\Controllers\General;

use App\Exports\DiscountItemsExport;
use App\Filters\DiscountItemFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\DiscountItem\DiscountItemCollection;
use App\Models\General\Discount;
use App\Models\General\DiscountItem;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DiscountItemController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the discount_item.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Discount $discount, Request $request, DiscountItemFilters $filters)
    {
        if (request()->expectsJson()) {
            return new DiscountItemCollection($discount->items()->filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['excel_export_endpoint'] = route('discounts.discount_items.export', $discount->id);

        return view('admin.globals.index-items', ['model' => $discount, 'data' => $data]);
    }

    /**
     * Show the form for creating a new discount_item.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Discount $discount)
    {
        return view('admin.globals.create', [
            'model'    => new DiscountItem,
            'discount' => $discount,
        ]);
    }

    /**
     * Store a newly created discount_item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Discount $discount, Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $discount->items()->create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('discounts.discount_items.index', ['discount' => $discount->id])]);
        }

        return redirect()
            ->route('discounts.discount_items.index', ['discount' => $discount->id])
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified discount_item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount, DiscountItem $discount_item)
    {
        //
    }

    /**
     * Show the form for editing the specified discount_item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount, DiscountItem $discount_item)
    {
        return view('admin.globals.edit', [
            'model'     => $discount_item,
            'edit_form' => true,
            'discount'  => $discount,
        ]);
    }

    /**
     * Update the specified discount_item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Discount $discount, DiscountItem $discount_item, Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $discount_item->update($data);

        success_flash();
        return response(['redirect' => route('discounts.discount_items.index', ['discount' => $discount->id])]);
    }

    /**
     * Remove the specified discount_item from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount, DiscountItem $discount_item)
    {
        return response([
            'result' => $discount_item->delete(),
        ]);
    }

    /**
     * Validate the discount_item store request.
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
     * Validate the discount_item update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, DiscountItem $discount_item)
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
    public function Export(Discount $discount, Request $request, DiscountItemFilters $filters)
    {
        $discount_items = new DiscountItemCollection($discount->items()->filter($filters)->get());
        return Excel::download(new DiscountItemsExport($discount_items), 'codes.xlsx');
    }
}
