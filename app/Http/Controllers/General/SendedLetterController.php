<?php

namespace App\Http\Controllers\General;

use App\Filters\SendedLetterFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\SendedLetter\SendedLetterCollection;
use App\Models\General\SendedLetter;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;
use PDF;

class SendedLetterController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the sended_letter.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, SendedLetterFilters $filters)
    {
        if (request()->expectsJson()) {
            return new SendedLetterCollection(SendedLetter::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new sended_letter.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new SendedLetter,
            'sizes' => config('portal.letter_sizes'),
        ]);
    }

    /**
     * Store a newly created sended_letter in storage.
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
        auth()->user()->sended_letters()->create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('sended_letters.index')]);
        }

        return redirect()
            ->route('sended_letters.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified sended_letter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SendedLetter $sended_letter)
    {
        //
    }

    /**
     * Show the form for editing the specified sended_letter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SendedLetter $sended_letter)
    {
        return view('admin.globals.edit', [
            'model'     => $sended_letter,
            'edit_form' => true,
            'sizes'     => config('portal.letter_sizes'),
        ]);
    }

    /**
     * Update the specified sended_letter in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SendedLetter $sended_letter)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $sended_letter->update($data);

        success_flash();
        return response(['redirect' => route('sended_letters.index')]);
    }

    /**
     * Remove the specified sended_letter from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SendedLetter $sended_letter)
    {
        return response([
            'result' => $sended_letter->delete(),
        ]);
    }

    public function export(SendedLetter $sended_letter)
    {
        $pdf = PDF::loadView('admin.pdf.sended_letter', compact('sended_letter'), [], ['format' => $sended_letter->size_name]);

        return $pdf->stream($sended_letter->title . '.pdf');
    }

    /**
     * Validate the sended_letter store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'date'        => 'nullable|string',
            'description' => 'nullable|string',
            'file'        => 'nullable|string',
            'size.id'     => 'required|in:1,2',
        ]);

        return multiselect_adapter($data);
    }

    /**
     * Validate the sended_letter update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, SendedLetter $sended_letter)
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
