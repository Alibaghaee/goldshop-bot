<?php

namespace App\Http\Controllers\General;

use App\Filters\ContentFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Content\ContentCollection;
use App\Models\General\Category;
use App\Models\General\CategoryItem;
use App\Models\General\Content;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the content.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ContentFilters $filters)
    {
        if (request()->expectsJson()) {
            return new ContentCollection(Content::with('category_item')->filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['categories'] = Category::asGroupOption(config('portal.content_module_id'));
        $data['options']['locales'] = config('portal.locales_option');

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new content.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::asGroupOption(config('portal.content_module_id'));
        $locales = config('portal.locales_option');
        return view('admin.globals.create', [
            'model' => new Content,
            'categories' => $categories,
            'locales' => $locales,
        ]);
    }

    /**
     * Store a newly created content in storage.
     *
     * @param \Illuminate\Http\Request $request
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
        Content::createContent($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('contents.index')]);
        }

        return redirect()
            ->route('contents.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified content.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified content.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        $categories = Category::asGroupOption(config('portal.content_module_id'));
        $category_items = CategoryItem::select('id', 'category_id', 'title as name')->get();
        $locales = config('portal.locales_option');

        return view('admin.globals.edit', [
            'model' => $content,
            'edit_form' => true,
            'categories' => $categories,
            'category_items' => $category_items,
            'locales' => $locales,
        ]);
    }

    /**
     * Update the specified content in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {
        // validate
        $data = $this->validateUpdate($request, $content);

        // create
        $content->updateContent($data);

        success_flash();
        return response(['redirect' => route('contents.index')]);
    }

    /**
     * Remove the specified content from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        return response([
            'result' => $content->delete(),
        ]);
    }

    /**
     * Validate the content store request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'category_item_id.id' => 'nullable|exists:category_items,id',
            'html_title' => 'max:255',
            'title' => 'max:255',
            'title_en' => 'max:255',
            'summary' => 'nullable',
            'summary_en' => 'nullable',
            'body' => 'nullable',
            'body_en' => 'nullable',
            'image' => 'max:255',
            'image2' => 'max:255',
            'image3' => 'max:255',
            'file' => 'max:255',
            'active' => 'boolean',
            'publish_date' => 'nullable|date',
            'expire_date' => 'nullable|date',
        ]);
    }

    /**
     * Validate the content update request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateUpdate(Request $request, Content $content)
    {
        return $request->validate([
            'category_item_id.id' => 'nullable|exists:category_items,id',
            'html_title' => 'max:255',
            'title' => 'max:255',
            'summary' => 'nullable',
            'body' => 'nullable',
            'title_en' => 'max:255',
            'summary_en' => 'nullable',
            'body_en' => 'nullable',
            'image' => 'max:255',
            'image2' => 'max:255',
            'image3' => 'max:255',
            'file' => 'max:255',
            'active' => 'boolean',
            'publish_date' => 'nullable|date',
            'expire_date' => 'nullable|date',
        ]);
    }

    public function validateFile(Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpeg,jpg,bmp,png',
            'image2' => 'mimes:jpeg,jpg,bmp,png',
            'image3' => 'mimes:jpeg,jpg,bmp,png',
            'file' => 'file|mimes:zip,pdf,xlsx,xls,doc,docx,jpeg,jpg,bmp,png',
        ]);
    }

    public function uploadFiles($request)
    {
        $this->validateFile($request);

        if ($request->has('image')) {
            return $request->user()->uploadFile($request->image, 'images/contents', true);
        }
        if ($request->has('image2')) {
            return $request->user()->uploadFile($request->image2, 'images/contents', true);
        }
        if ($request->has('image3')) {
            return $request->user()->uploadFile($request->image3, 'images/contents', true);
        }
        if ($request->has('file')) {
            return $request->user()->uploadFile($request->file, 'files/contents', true);
        }
    }
}
