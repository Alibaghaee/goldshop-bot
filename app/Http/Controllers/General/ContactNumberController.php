<?php

namespace App\Http\Controllers\General;

use App\Events\CreateContactNumberEvent;
use App\Filters\ContactNumberFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactNumber\ContactNumberCollection;
use App\Rules\MobileNumbers;
use App\Traits\Controllers\AdminGuard;
use App\Models\General\ContactNumber;
use App\Models\General\ContactCategory;
use Illuminate\Http\Request;

class ContactNumberController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the contact_number.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ContactNumberFilters $filters)
    {
        if (request()->expectsJson()) {
            return new ContactNumberCollection(ContactNumber::filter($filters)
                ->with('contactCategory')
                ->paginate(get_per_page($request)));
        }
        $data['options']['status_list'] = ContactNumber::$STATUS_LIST;
        $data['options']['gender_list'] = ContactNumber::$GENDER_LIST;

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new contact_number.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.globals.create', [
            'model' => new ContactNumber,
            'status' => ContactNumber::$STATUS_LIST,
            'gender' => ContactNumber::$GENDER_LIST,
            'contactCategories' => ContactCategory::published()->asGroupOption()->get(),
        ]);
    }

    /**
     * Store a newly created contact_number in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $contactNumber = ContactNumber::create($data);


        event(new CreateContactNumberEvent($contactNumber->load('contactCategory')));

        if (is_null(ContactNumber::find($contactNumber->id))) {

            flash_message('گروه مخاطبین ذخیره نشد.', 'error');
        } else {

            success_flash();
        }

        // return response
        if ($request->wantsJson()) {
            return response(['redirect' => route('contact_numbers.index')]);
        }

        return redirect()
            ->route('contact_numbers.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified contact_number.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(ContactNumber $contact_number)
    {
        //
    }

    /**
     * Show the form for editing the specified contact_number.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactNumber $contact_number)
    {
        return view('admin.globals.edit', [
            'model' => $contact_number,
            'edit_form' => true,
            'status' => ContactNumber::$STATUS_LIST,
            'gender' => ContactNumber::$GENDER_LIST,
            'contactCategories' => ContactCategory::published()->asGroupOption()->get(),

        ]);
    }

    /**
     * Update the specified contact_number in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactNumber $contact_number)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $contact_number->update($data);

        success_flash();
        return response(['redirect' => route('contact_numbers.index')]);
    }

    /**
     * Remove the specified contact_number from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactNumber $contact_number)
    {
        return response([
            'result' => $contact_number->delete(),
        ]);
    }

    /**
     * Validate the contact_number store request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'en_name' => 'nullable|string',
            'mobile' => ['required', new MobileNumbers()],
            'status' => 'required',
            'gender' => 'required',
            'contact_category_id' => 'required',
        ]);
        $data['status'] = $data['status']['id'];
        $data['gender'] = $data['gender']['id'];
        $data['contact_category_id'] = $data['contact_category_id']['id'];
        return $data;
    }

    /**
     * Validate the contact_number update request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateUpdate(Request $request, ContactNumber $contact_number)
    {
        return $request->validate([
            //
        ]);
    }
}
