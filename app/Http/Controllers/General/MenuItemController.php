<?php

namespace App\Http\Controllers\General;

use App\Filters\MenuItemFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\MenuItem\MenuItemCollection;
use App\Models\General\Menu;
use App\Models\General\MenuItem;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the menu_item.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Menu $menu, Request $request, MenuItemFilters $filters)
    {
        if (request()->expectsJson()) {
            return new MenuItemCollection($menu->items()->filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index-items', ['model' => $menu]);
    }

    /**
     * Show the form for creating a new menu_item.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Menu $menu)
    {
        return view('admin.globals.create', [
            'model' => new MenuItem,
            'menu'  => $menu,
        ]);
    }

    /**
     * Store a newly created menu_item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Menu $menu, Request $request)
    {
        // upload files
        if (is_upload_request($request)) {
            $this->validateImage($request);
            return $request->user()->uploadFile($request->image, 'images/menus', true);
        }

        // validate
        $data = $this->validateStore($request);

        // create
        $menu->items()->create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('menus.menu_items.index', ['menu' => $menu->id])]);
        }

        return redirect()
            ->route('menus.menu_items.index', ['menu' => $menu->id])
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified menu_item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu, MenuItem $menu_item)
    {
        //
    }

    /**
     * Show the form for editing the specified menu_item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu, MenuItem $menu_item)
    {
        return view('admin.globals.edit', [
            'model'     => $menu_item,
            'edit_form' => true,
            'menu'      => $menu,
        ]);
    }

    /**
     * Update the specified menu_item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Menu $menu, MenuItem $menu_item, Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $menu_item->update($data);

        success_flash();
        return response(['redirect' => route('menus.menu_items.index', ['menu' => $menu->id])]);
    }

    /**
     * Remove the specified menu_item from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu, MenuItem $menu_item)
    {
        return response([
            'result' => $menu_item->delete(),
        ]);
    }

    /**
     * Validate the menu_item store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'title'       => 'required|max:255',
            'image'       => 'max:255',
            'link'        => 'max:255',
            'description' => 'max:10000',
            'svg'         => 'max:10000',
            'active'      => 'boolean',
        ]);
    }

    /**
     * Validate the menu_item update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, MenuItem $menu_item)
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
