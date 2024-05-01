<?php

namespace App\Http\Controllers\General;

use App\Filters\MenuFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Menu\MenuCollection;
use App\Models\General\Menu;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the menu.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, MenuFilters $filters)
    {
        if (request()->expectsJson()) {
            return new MenuCollection(Menu::withCount('items')->filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['locales'] = config('portal.locales_option');

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new menu.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model'      => new Menu,
            'menu_types' => config('portal.menu_types'),
        ]);
    }

    /**
     * Store a newly created menu in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // upload files
        if (is_upload_request($request)) {
            $this->validateImage($request);
            return $request->user()->uploadFile($request->image, 'images/menus', true);
        }

        // validate
        $data = $this->validateStore($request);
        $data = multiselect_adapter($data);

        // create
        Menu::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('menus.index')]);
        }

        return redirect()
            ->route('menus.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified menu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified menu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('admin.globals.edit', [
            'model'      => $menu,
            'menu_types' => config('portal.menu_types'),
            'edit_form'  => true,
        ]);
    }

    /**
     * Update the specified menu in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        // validate
        $data = $this->validateStore($request);
        $data = multiselect_adapter($data);

        // update
        $menu->update($data);

        success_flash();
        return response(['redirect' => route('menus.index')]);
    }

    /**
     * Remove the specified menu from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        return response([
            'result' => $menu->remove(),
        ]);
    }

    /**
     * Validate the menu store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'title'        => 'required|string|max:255',
            'name'         => 'max:255',
            'link'         => 'max:255',
            'description'  => 'max:10000',
            'image'        => 'max:255',
            'depth'        => 'integer|max:3|nullable',
            'menu_type.id' => 'integer|in:1,2,3',
            'removable'    => 'boolean',
        ]);
    }

    /**
     * Validate the menu update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, Menu $menu)
    {
        return $request->validate([
            //
        ]);
    }

    public function validateImage(Request $request)
    {
        $request->validate(['avatar' => 'mimes:jpeg,jpg,bmp,png']);
    }
}
