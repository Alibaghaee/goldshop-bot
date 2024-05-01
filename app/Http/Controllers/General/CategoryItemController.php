<?php

namespace App\Http\Controllers\General;

use App\Filters\CategoryItemFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryItem\CategoryItemCollection;
use App\Models\General\Category;
use App\Models\General\CategoryItem;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CategoryItemController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the categoryitem.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category, Request $request, CategoryItemFilters $filters)
    {
        if (request()->expectsJson()) {
            return new CategoryItemCollection($category->items()->filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index-items', ['model' => $category]);
    }

    /**
     * Show the form for creating a new categoryitem.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        return view('admin.modules.category_items.create', [
            'model'     => new CategoryItem,
            'category'  => $category,
            'form_path' => $category->form_path,
        ]);
    }

    /**
     * Store a newly created categoryitem in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Category $category, Request $request)
    {
        // upload files
        if (is_upload_request($request)) {
            $this->validateImage($request);
            return $request->user()->uploadFile($request->image, 'images/categoryitems', true);
        }

        // validate
        $data = $this->validateStore($request);

        // create
        $category->items()->create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('categories.categoryitems.index', ['category' => $category->id])]);
        }

        return redirect()
            ->route('categories.categoryitems.index', ['category' => $category->id])
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified categoryitem.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, CategoryItem $categoryitem)
    {
        //
    }

    /**
     * Show the form for editing the specified categoryitem.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, CategoryItem $categoryitem)
    {
        return view('admin.modules.category_items.edit', [
            'model'     => $categoryitem,
            'category'  => $category,
            'form_path' => $category->form_path,
        ]);
    }

    /**
     * Update the specified categoryitem in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, CategoryItem $categoryitem, Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $categoryitem->update($data);

        success_flash();
        return response(['redirect' => route('categories.categoryitems.index', ['category' => $category->id])]);
    }

    /**
     * Remove the specified categoryitem from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, CategoryItem $categoryitem)
    {
        return response([
            'result' => $categoryitem->delete(),
        ]);
    }

    /**
     * Validate the categoryitem store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|string',
            'key'         => 'nullable|string',
        ]);
    }

    public function validateImage(Request $request)
    {
        $request->validate(['image' => 'mimes:jpeg,jpg,bmp,png']);
    }
}
