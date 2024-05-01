<?php

namespace App\Http\Controllers\General;

use App\Filters\ExpertFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Expert\ExpertCollection;
use App\Models\General\Department;
use App\Models\General\Expert;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the expert.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ExpertFilters $filters)
    {
        if (request()->expectsJson()) {
            return new ExpertCollection(Expert::with('department')->filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['departments'] = Department::asOption();

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new expert.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::asOption();

        return view('admin.globals.create', [
            'model'       => new Expert,
            'departments' => $departments,
        ]);
    }

    /**
     * Store a newly created expert in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // upload files
        if (is_upload_request($request)) {
            $this->validateImage($request);
            return $request->user()->uploadFile($request->image, 'images/experts/images', true);
        }

        // validate
        $data = $this->validateStore($request);

        // create
        $data = multiselect_adapter($data);
        Expert::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('experts.index')]);
        }

        return redirect()
            ->route('experts.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified expert.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Expert $expert)
    {
        //
    }

    /**
     * Show the form for editing the specified expert.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Expert $expert)
    {
        $departments = Department::asOption();

        return view('admin.globals.edit', [
            'model'       => $expert,
            'edit_form'   => true,
            'departments' => $departments,
        ]);
    }

    /**
     * Update the specified expert in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expert $expert)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $data = multiselect_adapter($data);
        $expert->update($data);

        success_flash();
        return response(['redirect' => route('experts.index')]);
    }

    /**
     * Remove the specified expert from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expert $expert)
    {
        return response([
            'result' => $expert->delete(),
        ]);
    }

    /**
     * Validate the expert store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'name'                => 'required|string|max:255',
            'family'              => 'required|string|max:255',
            'mobile'              => 'nullable|numeric',
            'phone'               => 'nullable|numeric',
            'address'             => 'nullable|string|max:1000',
            'visit_duration'      => 'required|integer|max:500',
            'visit_fee'           => 'required|integer',
            'expert_contribution' => 'nullable|integer|min:0|max:100',
            'description'         => 'nullable|string',
            'department_id.id'    => 'required|exists:departments,id',
        ]);
    }

    public function validateImage(Request $request)
    {
        $request->validate(['image' => 'mimes:jpeg,jpg,bmp,png']);
    }
}
