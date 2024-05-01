<?php

namespace App\Http\Controllers\General;

use App\Filters\DiscountFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Discount\DiscountCollection;
use App\Models\General\Discount;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the discount.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, DiscountFilters $filters)
    {
        if (request()->expectsJson()) {
            return new DiscountCollection(Discount::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new discount.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new Discount,
        ]);
    }

    /**
     * Store a newly created discount in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            'is_percent' => false,
            'max_uses'   => 1,
            'starts_at'  => now()->toDateTimeString(),
            'expires_at' => now()->addYears(5)->toDateTimeString(),
        ]);

        // validate
        $data = $this->validateStore($request);
        unset($data['code']);
        // dd($data);

        // create
        $discount = Discount::create($data);
        $discount->insertDiscountItems($data);

        if ($request->count == 1 && $request->has('code')) {
            $discount->items()->update(['code' => $request->code]);
        }

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('discounts.index')]);
        }

        return redirect()
            ->route('discounts.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified discount.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified discount.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        return view('admin.globals.edit', [
            'model'     => $discount,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified discount in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        // validate
        $data = $this->validateUpdate($request);

        // create
        $discount->update($data);
        $discount->updateDiscountItems($request->only(['discount_amount']));
        // $discount->updateDiscountItems($request->only(['discount_amount', 'max_uses', 'starts_at', 'expires_at']));

        success_flash();
        return response(['redirect' => route('discounts.index')]);
    }

    /**
     * Remove the specified discount from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        return response([
            'result' => $discount->delete(),
        ]);
    }

    /**
     * Validate the discount store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'title'           => 'required|string|max:255',
            'discount_amount' => 'required|integer',
            'is_percent'      => 'nullable|boolean',
            'count'           => 'required|integer',
            'max_uses'        => 'required|integer',
            'starts_at'       => 'required|date',
            'expires_at'      => 'required|date|after:starts_at',
            'code'            => 'nullable|string|max:50|unique:discount_items,code',
        ]);
    }

    /**
     * Validate the discount update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request)
    {
        return $request->validate([
            'title'           => 'required|string|max:255',
            'discount_amount' => 'required|integer',
            // 'max_uses'        => 'required|integer',
            // 'starts_at'       => 'required|date',
            // 'expires_at'      => 'required|date|after:starts_at',
        ]);
    }
}
