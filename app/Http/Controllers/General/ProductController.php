<?php

namespace App\Http\Controllers\General;

use App\Filters\ProductFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductCollection;
use App\Models\General\Category;
use App\Models\General\CategoryItem;
use App\Models\General\StudyField;
use App\Models\General\Package;
use App\Models\General\Product;
use App\Models\General\Tag;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProductFilters $filters, Package $package)
    {
        if (request()->expectsJson()) {
            return new ProductCollection(Product::withCount('items')->filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['categories'] = Category::asGroupOption(config('portal.product_module_id'));
        $data['options']['locales']    = config('portal.locales_option');
        $data['options']['tags']       = Tag::asOption();

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::asGroupOption(config('portal.product_module_id'));
        $locales    = config('portal.locales_option');
        $tags       = Tag::asOption();
        $fields     = StudyField::asOption();

        return view('admin.globals.create', [
            'model'      => new Product,
            'categories' => $categories,
            'locales'    => $locales,
            'tags'       => $tags,
            'fields'     => $fields,
        ]);
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // upload files
        if (is_upload_request($request)) {
            return $this->uploadFiles($request);
        }

        // validate
        $data = $this->validateStore($request);

        // create
        Product::createProduct($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('products.index')]);
        }

        return redirect()
            ->route('products.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories     = Category::asGroupOption(config('portal.product_module_id'));
        $category_items = CategoryItem::select('id', 'category_id', 'title as name')->get();
        $locales        = config('portal.locales_option');
        $tags           = Tag::asOption();
        $fields         = StudyField::asOption();

        return view('admin.globals.edit', [
            'model'          => $product,
            'edit_form'      => true,
            'categories'     => $categories,
            'category_items' => $category_items,
            'locales'        => $locales,
            'tags'           => $tags,
            'fields'         => $fields,
        ]);
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // validate
        $data = $this->validateUpdate($request, $product);

        // create
        $product->updateProduct($data);

        success_flash();
        return response(['redirect' => route('products.index')]);
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        return response([
            'result' => $product->delete(),
        ]);
    }

    /**
     * Validate the product store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        $data = $request->validate([
            // 'category_item_id.id' => 'required|exists:category_items,id',
            'html_title'   => 'max:255',
            'address_slug' => 'required|unique:products,address_slug,null,id|max:255',
            'title'        => 'max:255',
            // 'code'                => 'max:255',
            'price'        => 'max:255',
            'description'  => 'max:5000000',
            'detail'       => 'max:5000000',
            'image'        => 'max:255',
            'new'          => 'boolean',
            'active'       => 'boolean',
            // 'locale_id.id'        => 'required|integer:in' . implode(',', array_keys(config('portal.locales'))),
            'tags.*.id'    => 'exists:tags,id|nullable',
            'fields.*.id'  => 'nullable|exists:study_fields,id',
        ]);

        return $data;
    }

    /**
     * Validate the product update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, product $product)
    {

        $data = $request->validate([
            // 'category_item_id.id' => 'required|exists:category_items,id',
            'html_title'   => 'max:255',
            'address_slug' => 'required|unique:products,address_slug,' . $product->id . ',id|max:255',
            'title'        => 'max:255',
            // 'code'                => 'max:255',
            'price'        => 'max:255',
            'description'  => 'max:5000000',
            'detail'       => 'max:5000000',
            'image'        => 'max:255',
            'new'          => 'boolean',
            'active'       => 'boolean',
            // 'locale_id.id'        => 'required|integer:in' . implode(',', array_keys(config('portal.locales'))),
            'tags.*.id'    => 'exists:tags,id|nullable',
            'fields.*.id'  => 'nullable|exists:study_fields,id',
        ]);

        return $data;
    }

    public function validateFile(Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpeg,jpg,bmp,png',
            'file'  => 'file|mimes:zip,pdf,xlsx,xls,doc,docx,jpeg,jpg,bmp,png',
        ]);
    }

    public function uploadFiles($request)
    {
        $this->validateFile($request);

        if ($request->has('image')) {
            return $request->user()->uploadFile($request->image, 'images/products', true);
        }
    }
}
