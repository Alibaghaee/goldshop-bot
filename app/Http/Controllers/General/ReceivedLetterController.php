<?php

namespace App\Http\Controllers\General;

use App\Filters\ReceivedLetterFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReceivedLetter\ReceivedLetterCollection;
use App\Models\General\ReceivedLetter;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class ReceivedLetterController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the received_letter.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ReceivedLetterFilters $filters)
    {
        if (request()->expectsJson()) {
            return new ReceivedLetterCollection(ReceivedLetter::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new received_letter.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new ReceivedLetter,
        ]);
    }

    /**
     * Store a newly created received_letter in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // upload files
        if (is_upload_request($request) && $request->has('file')) {
            $this->validateFile($request);
            return $request->user()->uploadFile($request->file, 'letters/file', true);
        }

        // validate
        $data = $this->validateStore($request);

        // create
        ReceivedLetter::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('received_letters.index')]);
        }

        return redirect()
            ->route('received_letters.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified received_letter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ReceivedLetter $received_letter)
    {
        //
    }

    /**
     * Show the form for editing the specified received_letter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ReceivedLetter $received_letter)
    {
        return view('admin.globals.edit', [
            'model'     => $received_letter,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified received_letter in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReceivedLetter $received_letter)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $received_letter->update($data);

        success_flash();
        return response(['redirect' => route('received_letters.index')]);
    }

    /**
     * Remove the specified received_letter from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReceivedLetter $received_letter)
    {
        return response([
            'result' => $received_letter->delete(),
        ]);
    }

    /**
     * Validate the received_letter store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'title'       => 'required|string|max:255',
            'date'        => 'nullable|string',
            'description' => 'nullable|string',
            'file'        => 'nullable|string',
        ]);
    }

    /**
     * Validate the received_letter update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, ReceivedLetter $received_letter)
    {
        return $request->validate([
            //
        ]);
    }

    public function validateFile(Request $request)
    {
        $request->validate([
            'file' => 'file|mimes:jpeg,png,jpg,doc,docx,xls,xlsx,pdf,zip,7z',
        ]);
    }
}
