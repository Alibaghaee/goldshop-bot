<?php

namespace App\Http\Controllers\General;

use App\Filters\SmsTemplateFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\SmsTemplate\SmsTemplateCollection;
use App\Traits\Controllers\AdminGuard;
use App\Models\General\SmsTemplate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SmsTemplateController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the sms_template.
     *
     */
    public function index(Request $request, SmsTemplateFilters $filters)
    {
        if (request()->expectsJson()) {
            return new SmsTemplateCollection(SmsTemplate::filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['tags'] = SmsTemplate::$tagList;

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new sms_template.
     *
     */
    public function create()
    {
        $tags = SmsTemplate::$tagList;

        return view('admin.globals.create', [
            'model' => new SmsTemplate,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created sms_template in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);
        $data['tag'] = $data['tag']['name'];
        // create
        SmsTemplate::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('sms_templates.index')]);
        }

        return redirect()
            ->route('sms_templates.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified sms_template.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(SmsTemplate $sms_template)
    {
        //
    }

    /**
     * Show the form for editing the specified sms_template.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SmsTemplate $sms_template)
    {
        $tags = SmsTemplate::$tagList;

        return view('admin.globals.edit', [
            'model' => $sms_template,
            'edit_form' => true,
            'tags' => $tags,
        ]);
    }

    /**
     * Update the specified sms_template in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SmsTemplate $sms_template)
    {
        // validate
        $data = $this->validateUpdate($request);
//        $data['tag'] = $data['tag']['name'];

        // create
        $sms_template->update($data);

        success_flash();
        return response(['redirect' => route('sms_templates.index')]);
    }

    /**
     * Remove the specified sms_template from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmsTemplate $sms_template)
    {
        return response([
            'result' => $sms_template->delete(),
        ]);
    }

    /**
     * Validate the sms_template store request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'title' => 'required|string',
            'tag' => 'required|unique:sms_templates,tag',
            'description' => 'required|string',
        ]);
    }

    /**
     * Validate the sms_template update request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateUpdate(Request $request)
    {
        return $request->validate([
            'title' => 'required|string',
//            'tag' => 'required|unique:sms_templates,tag,' . optional($request->route('sms_template'))->id,
//            'tag' => ['required', Rule::unique('sms_templates', 'tag')->ignore(optional($request->route('sms_template'))->id)],
            'description' => 'required|string',

        ]);
    }
}
