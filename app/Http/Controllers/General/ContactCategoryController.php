<?php

namespace App\Http\Controllers\General;

use App\Events\CreateContactCategoryEvent;
use App\Filters\ContactCategoryFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\AsOptionResorceCollection;
use App\Http\Resources\ContactCategory\ContactCategoryCollection;
use App\Models\General\PanelSms;
use App\Traits\Controllers\AdminGuard;
use App\Models\General\ContactCategory;
use Illuminate\Http\Request;

class ContactCategoryController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the contact_category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ContactCategoryFilters $filters)
    {
        if (request()->expectsJson()) {
            return new ContactCategoryCollection(ContactCategory::filter($filters)
                ->with('panelSms')
                ->paginate(get_per_page($request)));
        }
        $data['options']['status_list'] = ContactCategory::$STATUS_LIST;
        $data['options']['panel_list'] = new AsOptionResorceCollection(PanelSms::published()->owner()->get());

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new contact_category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = json_encode(ContactCategory::$STATUS_LIST);

        return view('admin.globals.create', [
            'model' => new ContactCategory,
            'status' => $status,
            'panelSms' => new AsOptionResorceCollection(PanelSms::published()->owner()->get()),
        ]);
    }

    /**
     * Store a newly created contact_category in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $contactCategory = ContactCategory::create($data);

        event(new CreateContactCategoryEvent($contactCategory->load('panelSms')));
        if (is_null(ContactCategory::find($contactCategory->id))) {

            flash_message('گروه مخاطبین ذخیره نشد.', 'error');
        } else {

            success_flash();
        }

        // return response
        if ($request->wantsJson()) {

            return response(['redirect' => route('contact_categories.index')]);
        }

        return redirect()
            ->route('contact_categories.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified contact_category.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(ContactCategory $contact_category)
    {
        //
    }

    /**
     * Show the form for editing the specified contact_category.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactCategory $contact_category)
    {
        $status = ContactCategory::$STATUS_LIST;

        return view('admin.globals.edit', [
            'model' => $contact_category,
            'edit_form' => true,
            'status' => $status,
            'panelSms' => new AsOptionResorceCollection(PanelSms::published()->owner()->get()),

        ]);
    }

    /**
     * Update the specified contact_category in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactCategory $contact_category)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $contact_category->update($data);

        success_flash();
        return response(['redirect' => route('contact_categories.index')]);
    }

    /**
     * Remove the specified contact_category from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactCategory $contact_category)
    {
        return response([
            'result' => $contact_category->delete(),
        ]);
    }

    /**
     * Validate the contact_category store request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'status' => 'required',
            'panelSms' => 'required'
        ]);
        $data['status'] = $data['status']['id'];
        $data['panel_sms_id'] = $data['panelSms']['id'];
        unset($data['panelSms']);
        return $data;
    }

    /**
     * Validate the contact_category update request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateUpdate(Request $request, ContactCategory $contact_category)
    {
        return $request->validate([
            //
        ]);
    }
}
