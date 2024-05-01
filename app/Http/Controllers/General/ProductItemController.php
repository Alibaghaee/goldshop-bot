<?php

namespace App\Http\Controllers\General;

use App\Filters\ProductItemFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductItem\ProductItemCollection;
use App\Models\General\Product;
use App\Models\General\ProductItem;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class ProductItemController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the product_item.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product, Request $request, ProductItemFilters $filters)
    {
        if (request()->expectsJson()) {
            return new ProductItemCollection($product->items()->filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index-items', ['model' => $product]);
    }

    /**
     * Show the form for creating a new product_item.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('admin.globals.create', [
            'model'                     => new ProductItem,
            'product'                   => $product,
            'educational_content_types' => config('portal.educational_content_types'),
        ]);
    }

    /**
     * Store a newly created product_item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product, Request $request)
    {
        if (is_upload_request($request)) {
            $this->validateFile($request);

            if ($request->has('cover')) {
                return $request->user()->uploadFile($request->cover, 'images/product_item', true);
            }
            if ($request->has('file')) {
                return $request->user()->uploadFile($request->file, '/', true, 'files');
            }
            // different video quality upload
            if ($request->has('video_sd')) {
                return $request->user()->uploadFile($request->video_sd, $product->id . '/SD', false, 'files');
            }
            if ($request->has('video_hd')) {
                return $request->user()->uploadFile($request->video_hd, $product->id . '/HD', false, 'files');
            }
            if ($request->has('video_fhd')) {
                return $request->user()->uploadFile($request->video_fhd, $product->id . '/FHD', false, 'files');
            }

        }

        // validate
        $data = $this->validateStore($request);
        unset($data['convert']);

        // create
        $product_item = $product->items()->create($data);

        if ($request->convert == true) {
            $this->convert($product_item);
        }

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('products.product_items.index', ['product' => $product->id])]);
        }

        return redirect()
            ->route('products.product_items.index', ['product' => $product->id])
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified product_item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, ProductItem $product_item)
    {
        //
    }

    /**
     * Show the form for editing the specified product_item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, ProductItem $product_item)
    {
        return view('admin.globals.edit', [
            'model'                     => $product_item,
            'edit_form'                 => true,
            'product'                   => $product,
            'educational_content_types' => config('portal.educational_content_types'),
        ]);
    }

    /**
     * Update the specified product_item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, ProductItem $product_item, Request $request)
    {
        // validate
        $data = $this->validateStore($request);
        unset($data['convert']);

        // create
        $product_item->update($data);

        if ($request->convert == true) {
            $this->convert($product_item);
        }

        success_flash();
        return response(['redirect' => route('products.product_items.index', ['product' => $product->id])]);
    }

    /**
     * Remove the specified product_item from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, ProductItem $product_item)
    {
        return response([
            'result' => $product_item->delete(),
        ]);
    }

    /**
     * Validate the product_item store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|max:255',
            'cover'       => 'string|max:255',
            'file'        => 'max:255',
            'description' => 'max:10000',
            'active'      => 'boolean',
            'convert'     => 'boolean',
            'type.id'     => 'required',
        ]);
        $data = multiselect_adapter($data);
        if ($request->has('file')) {
            $data['file'] = pathinfo($data['file'], PATHINFO_BASENAME);
        }
        return $data;
    }

    /**
     * Validate the product_item update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, ProductItem $product_item)
    {
        return $request->validate([
            //
        ]);
    }

    public function validateFile(Request $request)
    {
        $request->validate([
            'file'      => 'file',
            'cover'     => 'mimes:jpeg,jpg,bmp,png',
            'video_sd'  => 'file',
            'video_hd'  => 'file',
            'video_fhd' => 'file',
        ]);
    }

    protected function convert($product_item)
    {
        $path_info = pathinfo($product_item->file);
        if ($path_info['extension'] == 'mp4') {
            dispatch_video_convert_jobs($product_item->product->id, $path_info['basename']);
        }
    }
}
