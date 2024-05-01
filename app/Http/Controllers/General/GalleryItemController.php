<?php

namespace App\Http\Controllers\General;

use App\Filters\GalleryItemFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryItem\GalleryItemCollection;
use App\Models\General\Gallery;
use App\Models\General\GalleryItem;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class GalleryItemController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the gallery_item.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Gallery $gallery, Request $request, GalleryItemFilters $filters)
    {
        if (request()->expectsJson()) {
            return new GalleryItemCollection($gallery->items()->filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index-items', ['model' => $gallery]);
    }

    /**
     * Show the form for creating a new gallery_item.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Gallery $gallery)
    {
        return view('admin.globals.create', [
            'model'   => new GalleryItem,
            'gallery' => $gallery,
        ]);
    }

    /**
     * Store a newly created gallery_item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Gallery $gallery, Request $request)
    {
        // upload files
        if (is_upload_request($request)) {
            return $this->uploadFiles($request, $gallery);
        }

        // validate
        $data = $this->validateStore($request);

        // create
        $gallery->items()->create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('galleries.gallery_items.index', ['gallery' => $gallery->id])]);
        }

        return redirect()
            ->route('galleries.gallery_items.index', ['gallery' => $gallery->id])
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified gallery_item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery, GalleryItem $gallery_item)
    {
        //
    }

    /**
     * Show the form for editing the specified gallery_item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery, GalleryItem $gallery_item)
    {
        return view('admin.globals.edit', [
            'model'     => $gallery_item,
            'edit_form' => true,
            'gallery'   => $gallery,
        ]);
    }

    /**
     * Update the specified gallery_item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Gallery $gallery, GalleryItem $gallery_item, Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $gallery_item->update($data);

        success_flash();
        return response(['redirect' => route('galleries.gallery_items.index', ['gallery' => $gallery->id])]);
    }

    /**
     * Remove the specified gallery_item from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery, GalleryItem $gallery_item)
    {
        return response([
            'result' => $gallery_item->delete(),
        ]);
    }

    /**
     * Validate the gallery_item store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'title'       => 'required',
            'image'       => 'required',
            'link'        => 'nullable',
            'description' => 'nullable',
            'active'      => 'boolean',
        ]);
    }

    /**
     * Validate the gallery_item update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, GalleryItem $gallery_item)
    {
        return $request->validate([
            'title'       => 'required',
            'image'       => 'required',
            'link'        => 'nullable',
            'description' => 'nullable',
            'active'      => 'boolean',
        ]);
    }

    public function validateFile(Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
    }

    public function uploadFiles($request, Gallery $gallery)
    {
        $this->validateFile($request);

        if ($request->has('image')) {
            return $request->user()->uploadFile($request->image, 'images/galleries/' . $gallery->id, true);
        }
    }
}
