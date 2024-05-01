<?php

namespace App\Http\Controllers\General;

use App\Filters\CategoryFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryCollection;
use App\Models\General\Category;
use App\Models\General\Module;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CategoryFilters $filters)
    {
        if (request()->expectsJson()) {
            return new CategoryCollection(Category::with('module')->withCount('items')->filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['modules'] = Module::asOption();

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model'   => new Category,
            'modules' => Module::getOptions(),
        ]);
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // upload files
        if (is_upload_request($request)) {
            $this->validateImage($request);
            return $request->user()->uploadFile($request->image, 'images/categories', true);
        }

        // validate
        $data = $this->validateStore($request);
        $data = multiselect_adapter($data);

        // create
        Category::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('categories.index')]);
        }

        return redirect()
            ->route('categories.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.globals.edit', [
            'model'     => $category,
            'edit_form' => true,
            'modules'   => Module::getOptions(),
        ]);
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // upload files
        if (is_upload_request($request)) {
            $this->validateImage($request);
            return $request->user()->uploadFile($request->image, 'images/categories', true);
        }

        // validate
        $data = $this->validateStore($request);
        $data = multiselect_adapter($data);

        // create
        $category->update($data);

        success_flash();
        return response(['redirect' => route('categories.index')]);
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        return response([
            'result' => $category->delete(),
        ]);
    }

    /**
     * Validate the category store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'title'        => 'required|string|max:255',
            'module_id.id' => 'required|exists:modules,id',
            'image'        => 'nullable|string',
        ]);
    }

    public function validateImage(Request $request)
    {
        $request->validate(['image' => 'mimes:jpeg,jpg,bmp,png']);
    }
}
