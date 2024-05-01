<?php

namespace App\Http\Controllers\General;

use App\Filters\TabiatProductCategoryFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\TabiatProductCategory\TabiatProductCategoryCollection;
use App\Models\General\TabiatProductCategory;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class TabiatProductCategoryController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the tabiat_product_category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, TabiatProductCategoryFilters $filters)
    {
        if (request()->expectsJson()) {
            return new TabiatProductCategoryCollection(TabiatProductCategory::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new tabiat_product_category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new TabiatProductCategory,
        ]);
    }

    /**
     * Store a newly created tabiat_product_category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        TabiatProductCategory::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('tabiat_product_categories.index')]);
        }

        return redirect()
            ->route('tabiat_product_categories.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified tabiat_product_category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TabiatProductCategory $tabiat_product_category)
    {
        //
    }

    /**
     * Show the form for editing the specified tabiat_product_category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TabiatProductCategory $tabiat_product_category)
    {
        return view('admin.globals.edit', [
            'model'     => $tabiat_product_category,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified tabiat_product_category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TabiatProductCategory $tabiat_product_category)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $tabiat_product_category->update($data);

        success_flash();
        return response(['redirect' => route('tabiat_product_categories.index')]);
    }

    /**
     * Remove the specified tabiat_product_category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TabiatProductCategory $tabiat_product_category)
    {
        return response([
            'result' => $tabiat_product_category->delete(),
        ]);
    }

    /**
     * Validate the tabiat_product_category store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'title'       => 'required|max:255',
            'description' => 'nullable',
        ]);
    }

    /**
     * Validate the tabiat_product_category update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, TabiatProductCategory $tabiat_product_category)
    {
        return $request->validate([
            //
        ]);
    }
}
