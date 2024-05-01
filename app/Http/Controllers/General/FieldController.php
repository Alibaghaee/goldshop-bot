<?php

namespace App\Http\Controllers\General;

use App\Filters\FieldFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Field\FieldCollection;
use App\Models\General\Category;
use App\Models\General\Field;
use App\Models\General\Rule;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class FieldController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the field.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, FieldFilters $filters)
    {
        if (request()->expectsJson()) {
            return new FieldCollection(Field::filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['types'] = config('portal.form.field_types');

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new field.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('module_id', config('portal.form_module_id'))->asOption();

        return view('admin.globals.create', [
            'model'            => new Field,
            'types'            => config('portal.form.field_types'),
            'form_fields_name' => config('portal.form_fields_name'),
            'categories'       => $categories,
            'rules'            => Rule::asOption(),
        ]);
    }

    /**
     * Store a newly created field in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateStore($request);

        $rules = Arr::get($data, 'rules');
        $data  = Arr::except($data, ['rules']);

        $field = Field::create($data);
        $field->rules()->sync($rules);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('fields.index')]);
        }

        return redirect()
            ->route('fields.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Show the form for editing the specified field.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Field $field)
    {
        $categories = Category::where('module_id', config('portal.form_module_id'))->asOption();

        return view('admin.globals.edit', [
            'model'            => $field,
            'edit_form'        => true,
            'types'            => config('portal.form.field_types'),
            'form_fields_name' => config('portal.form_fields_name'),
            'categories'       => $categories,
            'rules'            => Rule::asOption(),
        ]);
    }

    /**
     * Update the specified field in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Field $field)
    {
        $data = $this->validateStore($request);

        $rules = Arr::get($data, 'rules');
        $data  = Arr::except($data, ['rules']);

        $field->update($data);
        $field->rules()->sync($rules);

        success_flash();
        return response(['redirect' => route('fields.index')]);
    }

    /**
     * Remove the specified field from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Field $field)
    {
        return response([
            'result' => $field->delete(),
        ]);
    }

    /**
     * Validate the field store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        $data = $request->validate([
            'name.name'      => 'required',
            'type.id'        => 'required',
            'label'          => 'required|max:255',
            'category_id.id' => 'required_if:type,3',
            'default_value'  => 'nullable|string',
            'rules.*.id'     => 'required|exists:rules,id',
        ]);

        $data['name'] = Arr::get($data['name'], 'name');

        $data = multiselect_adapter($data);

        return $data;
    }

    /**
     * Validate the field update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, Field $field)
    {
        return $request->validate([
            //
        ]);
    }
}
