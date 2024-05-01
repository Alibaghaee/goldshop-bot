<?php

namespace App\Http\Controllers\General;

use App\Filters\DepartmentFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Department\DepartmentCollection;
use App\Models\General\Department;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the department.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, DepartmentFilters $filters)
    {
        if (request()->expectsJson()) {
            return new DepartmentCollection(Department::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new department.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new Department,
        ]);
    }

    /**
     * Store a newly created department in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        Department::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('departments.index')]);
        }

        return redirect()
            ->route('departments.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified department.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified department.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('admin.globals.edit', [
            'model'     => $department,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified department in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $department->update($data);

        success_flash();
        return response(['redirect' => route('departments.index')]);
    }

    /**
     * Remove the specified department from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        return response([
            'result' => $department->delete(),
        ]);
    }

    /**
     * Validate the department store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'title'       => 'required|max:255',
            'description' => 'string',
        ]);
    }
}
