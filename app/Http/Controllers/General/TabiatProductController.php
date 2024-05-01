<?php

namespace App\Http\Controllers\General;

use App\Filters\TabiatProductFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\TabiatProduct\TabiatProductCollection;
use App\Models\General\TabiatProduct;
use App\Models\General\TabiatProductCategory;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class TabiatProductController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the tabiat_product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, TabiatProductFilters $filters)
    {
        if (request()->expectsJson()) {
            return new TabiatProductCollection(
                TabiatProduct::query()
                    ->with('tabiat_product_category')
                    ->filter($filters)
                    ->paginate(get_per_page($request))
            );
        }

        $data['options']['tabiat_product_categories'] = TabiatProductCategory::asOption();

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new tabiat_product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model'                     => new TabiatProduct,
            'tabiat_product_categories' => TabiatProductCategory::asOption(),
        ]);
    }

    /**
     * Store a newly created tabiat_product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        TabiatProduct::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('tabiat_products.index')]);
        }

        return redirect()
            ->route('tabiat_products.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified tabiat_product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TabiatProduct $tabiat_product)
    {
        //
    }

    /**
     * Show the form for editing the specified tabiat_product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TabiatProduct $tabiat_product)
    {
        return view('admin.globals.edit', [
            'model'                     => $tabiat_product,
            'tabiat_product_categories' => TabiatProductCategory::asOption(),
            'edit_form'                 => true,
        ]);
    }

    /**
     * Update the specified tabiat_product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TabiatProduct $tabiat_product)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $tabiat_product->update($data);

        success_flash();
        return response(['redirect' => route('tabiat_products.index')]);
    }

    /**
     * Remove the specified tabiat_product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TabiatProduct $tabiat_product)
    {
        return response([
            'result' => $tabiat_product->delete(),
        ]);
    }

    /**
     * Validate the tabiat_product store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        $data = $request->validate([
            'tabiat_product_category_id.id' => 'required',
            'title'                         => 'required|max:255',
            'description'                   => 'nullable',
        ]);

        $data = multiselect_adapter($data);

        return $data;
    }

    /**
     * Validate the tabiat_product update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, TabiatProduct $tabiat_product)
    {
        return $request->validate([
            //
        ]);
    }
}
