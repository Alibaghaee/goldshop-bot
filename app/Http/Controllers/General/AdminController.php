<?php

namespace App\Http\Controllers\General;

use App\Filters\AdminFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminCollection;
use App\Models\General\Admin;
use App\Models\General\Category;
use App\Models\General\CategoryItem;
use App\Traits\Controllers\AdminGuard;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, AdminFilters $filters)
    {
        if (request()->expectsJson()) {
            return new AdminCollection($this->guard()->user()->childs()->filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['levels']     = $this->guard()->user()->getOwnedLevelOptions();
        $data['options']['roles']      = $this->guard()->user()->getOwnedRoleOptions();
        $data['options']['categories'] = Category::asGroupOption(1);

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'levels'     => $this->guard()->user()->getOwnedLevelOptions(),
            'roles'      => $this->guard()->user()->getOwnedRoleOptions(),
            'model'      => new Admin,
            'categories' => Category::asGroupOption(config('portal.staff_category_id')),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // upload files
        if (is_upload_request($request) && $request->has('avatar')) {
            $this->validateFile($request);
            return $request->user()->uploadFile($request->avatar, 'images/avatar', true);
        }
        if (is_upload_request($request) && $request->has('document')) {
            $this->validateFile($request);
            return $request->user()->uploadFile($request->document, 'files/document', true);
        }

        // validate
        $data = $this->validateStore($request);

        // create
        $this->guard()->user()->createAdmin($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('admins.index')]);
        }

        return redirect()
            ->route('admins.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // authorize loaded admin to be in authenticated admin childs
        $admin          = $this->guard()->user()->childs()->findOrFail($id);
        $category_items = CategoryItem::AsOptionForMultiselect();

        return view('admin.globals.edit', [
            'levels'         => $this->guard()->user()->getOwnedLevelOptions(),
            'roles'          => $this->guard()->user()->getOwnedRoleOptions(),
            'model'          => $admin,
            'edit_form'      => true,
            'categories'     => Category::asGroupOption(1),
            'category_items' => $category_items,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // authorize loaded admin to be in authenticated admin childs
        $admin = $this->guard()->user()->childs()->findOrFail($id);

        // validate
        $data = $this->validateUpdate($request, $admin);

        // update admin
        $result = $admin->updateAdmin($data);

        success_flash();
        return response(['redirect' => route('admins.index')]);
    }

    /**
     * Remove admin from storage if is children of the requester admin.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = $this->guard()->user()->childs()->findOrFail($id);

        return response([
            'result' => $admin->delete(),
        ]);
    }

    private function validateStore(Request $request)
    {
        $levels_id = $this->guard()->user()->getOwnedLevelsId();
        $roles_id  = $this->guard()->user()->getOwnedRolesId();

        return $request->validate([
            'level_id.id' => "required|in:$levels_id",
            'role_id.id'  => "required|in:$roles_id",
            // 'category_item_id.id' => "required",
            'name'        => 'required|max:255',
            'family'      => 'required|max:255',
            'username'    => 'required|unique:admins,username',
            'email'       => 'required|email|unique:admins,email',
            'password'    => 'required|confirmed|max:255',
            'address'     => 'nullable|string|max:1000',
            'mobile'      => 'nullable|numeric',
            'phone'       => 'nullable|numeric',
            'enter_time'  => 'required|date_format:H:i',
            'exit_time'   => 'required|date_format:H:i',
            'avatar'      => 'nullable|string',
            'document'    => 'nullable|string',
        ]);
    }

    private function validateUpdate(Request $request, $admin)
    {
        $levels_id = $this->guard()->user()->getOwnedLevelsId();
        $roles_id  = $this->guard()->user()->getOwnedRolesId();

        return $request->validate([
            'level_id.id' => "required|in:$levels_id",
            'role_id.id'  => "required|in:$roles_id",
            // 'category_item_id.id' => "required",
            'name'        => 'required|max:255',
            'family'      => 'required|max:255',
            'username'    => "required|unique:admins,username,$admin->id,id",
            'email'       => "required|email|unique:admins,email,$admin->id,id",
            'password'    => 'confirmed|max:255',
            'address'     => 'nullable|string|max:1000',
            'mobile'      => 'nullable|numeric',
            'phone'       => 'nullable|numeric',
            'enter_time'  => 'required|date_format:H:i',
            'exit_time'   => 'required|date_format:H:i',
            'avatar'      => 'nullable|string',
            'document'    => 'nullable|string',
        ]);
    }

    public function validateFile(Request $request)
    {
        $request->validate([
            'avatar'   => 'mimes:jpeg,jpg,bmp,png',
            'document' => 'file|mimes:jpeg,png,jpg,doc,docx,xls,xlsx,pdf,zip,7z',
        ]);
    }

}
