<?php

namespace App\Http\Controllers\General;

use App\Filters\ReferFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Refer\ReferCollection;
use App\Models\General\Admin;
use App\Models\General\Refer;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class ReferController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the refer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ReferFilters $filters)
    {
        if (request()->expectsJson()) {
            return new ReferCollection(Refer::owned()->with('task')->filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['admins']       = Admin::asOption();
        $data['options']['refer_status'] = config('portal.refer_status');

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new refer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admins = Admin::asOption();

        return view('admin.globals.create', [
            'model'  => new Refer,
            'admins' => $admins,
        ]);
    }

    /**
     * Store a newly created refer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // upload files
        if (is_upload_request($request)) {
            $this->validateAvatar($request);
            return $request->user()->uploadFile($request->file, 'files/refer', true);
        }
    }

    /**
     * Finish refer - cant be referred
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Refer $refer)
    {
        $result = Refer::owned()->findOrFail($refer->id)->update(['referred' => true]);

        return response([
            'result' => $result,
        ]);
    }

    /**
     * Show the form for editing the specified refer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Refer $refer)
    {
        if ($refer->referred == true) {
            return redirect()
                ->route('refers.index')
                ->with('flash', 'این مورد قبلا ارجاع شده است. امکان ارجاع دوباره وجود ندارد.')
                ->with('level', 'error');
        }

        $admins = Admin::asOptionExceptMe();

        return view('admin.globals.edit', [
            'model'     => $refer,
            'admins'    => $admins,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified refer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Refer $refer)
    {
        if ($refer->referred == true) {
            flash_message('این مورد قبلا ارجاع شده است. امکان ارجاع دوباره وجود ندارد.', 'error');
            return response(['redirect' => route('refers.index')]);
        }

        if ($refer->to_admin_id != auth()->id()) {
            return response(['redirect' => route('refers.index')]);
        }

        // validate
        $data = $this->validateStore($request);

        // create
        $refer->createRefer($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('refers.index')]);
        }
    }

    /**
     * Remove the specified refer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Refer $refer)
    {
        return response([
            'result' => $refer->delete(),
        ]);
    }

    /**
     * Validate the refer store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'to_admin_id.id' => 'required|exists:admins,id',
            'description'    => 'required|string|max:5000',
            'file'           => 'string',
        ]);
    }

    /**
     * Validate the refer update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, Refer $refer)
    {
        return $request->validate([
            //
        ]);
    }

    public function validateAvatar(Request $request)
    {
        $request->validate(['file' => 'file|mimes:jpeg,png,jpg,doc,docx,xls,xlsx,pdf,zip,7z']);
    }
}
