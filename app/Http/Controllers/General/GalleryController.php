<?php

namespace App\Http\Controllers\General;

use App\Filters\GalleryFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Gallery\GalleryCollection;
use App\Models\General\Category;
use App\Models\General\CategoryItem;
use App\Models\General\Gallery;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the gallery.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, GalleryFilters $filters)
    {
        if (request()->expectsJson()) {
            return new GalleryCollection(Gallery::withCount('items')->filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['categories'] = Category::asGroupOption();
        $data['options']['locales']    = config('portal.locales_option');

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new gallery.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::asGroupOption();
        $locales    = config('portal.locales_option');

        return view('admin.globals.create', [
            'model'      => new Gallery,
            'categories' => $categories,
            'locales'    => $locales,
        ]);
    }

    /**
     * Store a newly created gallery in storage.
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
        $data = multiselect_adapter($data);
        Gallery::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('galleries.index')]);
        }

        return redirect()
            ->route('galleries.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified gallery.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified gallery.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        $categories     = Category::asGroupOption();
        $category_items = CategoryItem::select('id', 'category_id', 'title as name')->get();
        $locales        = config('portal.locales_option');

        return view('admin.globals.edit', [
            'model'          => $gallery,
            'edit_form'      => true,
            'categories'     => $categories,
            'category_items' => $category_items,
            'locales'        => $locales,
        ]);
    }

    /**
     * Update the specified gallery in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        // validate
        $data = $this->validateUpdate($request);

        // update
        $data = multiselect_adapter($data);
        $gallery->update($data);

        success_flash();
        return response(['redirect' => route('galleries.index')]);
    }

    /**
     * Remove the specified gallery from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        return response([
            'result' => $gallery->delete(),
        ]);
    }

    /**
     * Validate the gallery store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'title'               => 'required|max:255',
            'category_item_id.id' => 'required|exists:category_items,id',
            'image'               => 'required|max:255',
            'description'         => 'nullable',
            'locale_id.id'        => 'required|integer:in' . implode(',', array_keys(config('portal.locales'))),
            'active'              => 'boolean',
        ]);
    }

    /**
     * Validate the gallery update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request)
    {
        return $request->validate([
            'title'               => 'required|max:255',
            'category_item_id.id' => 'required|exists:category_items,id',
            'image'               => 'required|max:255',
            'description'         => 'nullable',
            'locale_id.id'        => 'required|integer:in' . implode(',', array_keys(config('portal.locales'))),
            'active'              => 'boolean',
        ]);
    }

    public function validateFile(Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
    }

    public function uploadFiles($request)
    {
        $this->validateFile($request);

        if ($request->has('image')) {
            return $request->user()->uploadFile($request->image, 'images/galleries', true);
        }
    }
}
