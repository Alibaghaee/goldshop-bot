<?php

namespace App\Http\Controllers\General;

use App\Filters\FormFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Form\FormCollection;
use App\Models\General\Field;
use App\Models\General\Form;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class FormController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, FormFilters $filters)
    {
        if (request()->expectsJson()) {
            return new FormCollection(Form::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new form.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model'  => new Form,
            'fields' => Field::asOption(),
        ]);
    }

    /**
     * Store a newly created form in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        $fields = Arr::get($data, 'fields');
        $data   = Arr::except($data, ['fields']);

        $form = Form::create($data);
        $form->fields()->detach();
        $form->fields()->sync($fields);

        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('forms.index')]);
        }

        return redirect()
            ->route('forms.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Show the form for editing the specified form.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form)
    {
        return view('admin.globals.edit', [
            'model'     => $form,
            'edit_form' => true,
            'fields'    => Field::asOption(),
        ]);
    }

    /**
     * Update the specified form in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form)
    {
        $data = $this->validateStore($request);

        $fields = Arr::get($data, 'fields');
        $data   = Arr::except($data, ['fields']);

        $form->update($data);
        $form->fields()->detach();
        $form->fields()->sync($fields);

        success_flash();
        return response(['redirect' => route('forms.index')]);
    }

    /**
     * Remove the specified form from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        return response([
            'result' => $form->delete(),
        ]);
    }

    /**
     * Validate the form store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|max:255',
            'fields.*.id' => 'nullable|exists:fields,id',
        ]);

        $data = multiselect_adapter($data);

        return $data;
    }

    /**
     * Validate the form update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, Form $form)
    {
        return $request->validate([
            //
        ]);
    }
}
