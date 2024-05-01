<?php

namespace App\Http\Controllers\General;

use App\Exports\TasksExport;
use App\Filters\TaskFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Task\TaskCollection;
use App\Models\General\Admin;
use App\Models\General\Task;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TaskController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the task.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, TaskFilters $filters)
    {
        if (request()->expectsJson()) {
            return new TaskCollection(Task::filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['admins']        = Admin::asOption();
        $data['options']['task_status']   = config('portal.task_status');
        $data['options']['report_status'] = config('portal.report_status');

        return view('admin.modules.tasks.index', compact('data'));
    }

    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admins = Admin::asOption();

        return view('admin.globals.create', [
            'model'  => new Task,
            'admins' => $admins,
        ]);
    }

    /**
     * Store a newly created task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // upload files
        if (is_upload_request($request)) {
            $this->validateAvatar($request);
            return $request->user()->uploadFile($request->file, 'files/task', true);
        }

        // validate
        $data = $this->validateStore($request);

        // create
        $data = multiselect_adapter($data);
        $task = auth()->user()->task()->create($data);

        $task->refers()->create([
            'from_admin_id' => auth()->id(),
            'to_admin_id'   => $task->assigned_to_admin_id,
            'description'   => $task->description,
            'file'          => $task->file,
        ]);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('tasks.index')]);
        }

        return redirect()
            ->route('tasks.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified task.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $admins = Admin::asOption();

        return view('admin.globals.edit', [
            'model'     => $task,
            'admins'    => $admins,
            'status'    => config('portal.task_status'),
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        // validate
        $data = $this->validateUpdate($request);

        // create
        $data = multiselect_adapter($data);
        $task->update($data);

        success_flash();
        return response(['redirect' => route('tasks.index')]);
    }

    /**
     * Remove the specified task from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        return response([
            'result' => $task->delete(),
        ]);
    }

    /**
     * Export  as Excel
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Export(Request $request, TaskFilters $filters)
    {
        $tasks = new TaskCollection(Task::filter($filters)->get());
        return Excel::download(new TasksExport($tasks), 'tasks.xlsx');
    }

    /**
     * Validate the task store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'assigned_to_admin_id.id' => 'required|exists:admins,id',
            'description'             => 'required|string|max:5000',
            'start_date'              => 'required|date',
            'deadline'                => 'required|date|after:start_date',
            'file'                    => 'string',
        ]);
    }

    /**
     * Validate the task update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request)
    {
        return $request->validate([
            'description'        => 'required|string|max:5000',
            'start_date'         => 'required|date',
            'deadline'           => 'required|date|after:start_date',
            'status.id'          => 'integer|nullable',
            'reported_at'        => 'date|after:start_date|nullable',
            'report_description' => 'string|max:5000',
            'file'               => 'string',
        ]);
    }

    public function validateAvatar(Request $request)
    {
        $request->validate(['file' => 'file|mimes:jpeg,png,jpg,doc,docx,xls,xlsx,pdf,zip,7z']);
    }

    public function report(Request $request, TaskFilters $filters)
    {
        return [
            'total'                  => Task::filter($filters)->count(),
            'task_status_incomplete' => Task::filter($filters)->where('status', 1)->count(),
            'task_status_pending'    => Task::filter($filters)->where('status', 2)->count(),
            'task_status_complete'   => Task::filter($filters)->where('status', 3)->count(),
            'task_status_null'       => Task::filter($filters)->where('status', null)->count(),
        ];
    }

}
