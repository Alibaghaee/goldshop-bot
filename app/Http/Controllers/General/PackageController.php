<?php

namespace App\Http\Controllers\General;

use App\Filters\PackageFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Package\PackageCollection;
use App\Models\General\Category;
use App\Models\General\Form;
use App\Models\General\Package;
use App\Models\General\Product;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PackageController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the package.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PackageFilters $filters)
    {
        if (request()->expectsJson()) {
            return new PackageCollection(Package::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new package.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('module_id', config('portal.package_module_id'))->asOption();

        return view('admin.globals.create', [
            'model'      => new Package,
            'products'   => Product::asOption(),
            'categories' => $categories,
            'forms'      => Form::asOption(),
        ]);
    }

    /**
     * Store a newly created package in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // upload files
        if (is_upload_request($request) && $request->has('image')) {
            $this->validateFile($request);
            return $request->user()->uploadFile($request->image, 'images/package/image', true);
        }

        // validate
        $data = $this->validateStore($request);

        // create
        $data     = multiselect_adapter($data);
        $products = Arr::get($data, 'products');
        $data     = Arr::except($data, ['products']);
        $package  = Package::create($data);
        $package->products()->sync($products);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('packages.index')]);
        }

        return redirect()
            ->route('packages.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified package.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified package.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        $categories = Category::where('module_id', config('portal.package_module_id'))->asOption();

        return view('admin.globals.edit', [
            'model'      => $package,
            'edit_form'  => true,
            'products'   => Product::asOption(),
            'categories' => $categories,
            'forms'      => Form::asOption(),
        ]);
    }

    /**
     * Update the specified package in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $data     = multiselect_adapter($data);
        $products = Arr::get($data, 'products');
        $data     = Arr::except($data, ['products']);
        $package->update($data);
        $package->products()->sync($products);

        success_flash();
        return response(['redirect' => route('packages.index')]);
    }

    /**
     * Remove the specified package from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        return response([
            'result' => $package->delete(),
        ]);
    }

    /**
     * Validate the package store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'title'                     => 'required|string',
            'form_id.id'                => 'required|exists:forms,id',
            'info'                      => 'required|string',
            'national_code_description' => 'nullable|string',
            'first_description'         => 'required|string',
            'second_description'        => 'required|string',
            'agreement_text'            => 'required|string',
            'price'                     => 'required|integer',
            'allow_installment'         => 'nullable|boolean',
            'pre_payment'               => 'nullable|integer',
            'image'                     => 'required|string',
            'full_payment_message'      => 'required|string',
            'pre_payment_message'       => 'required|string',
            'products.*.id'             => 'nullable|exists:products,id',
            'category_id.id'            => 'required|exists:categories,id',
            'active'                    => 'nullable|boolean',
        ]);
    }

    /**
     * Validate the package update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, Package $package)
    {
        return $request->validate([
            //
        ]);
    }

    public function validateFile(Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
    }
}
