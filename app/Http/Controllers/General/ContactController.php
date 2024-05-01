<?php

namespace App\Http\Controllers\General;

use App\Filters\ContactFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Contact\ContactCollection;
use App\Traits\Controllers\AdminGuard;
use App\Models\General\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ContactFilters $filters)
    {
        if (request()->expectsJson()) {
            return new ContactCollection(Contact::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new Contact,
        ]);
    }

    /**
     * Store a newly created contact in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        Contact::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('contacts.index')]);
        }

        return redirect()
            ->route('contacts.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified contact.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified contact.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('admin.globals.edit', [
            'model'     => $contact,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified contact in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $contact->update($data);

        success_flash();
        return response(['redirect' => route('contacts.index')]);
    }

    /**
     * Remove the specified contact from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        return response([
            'result' => $contact->delete(),
        ]);
    }

    /**
     * Validate the contact store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            //
        ]);
    }

    /**
     * Validate the contact update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, Contact $contact)
    {
        return $request->validate([
            //
        ]);
    }
}
