<?php

namespace App\Http\Controllers\General;

use App\Filters\AnswerFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Answer\AnswerCollection;
use App\Models\General\Answer;
use App\Models\General\Ticket;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the answer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ticket $ticket, Request $request, AnswerFilters $filters)
    {
        if (request()->expectsJson()) {
            return new AnswerCollection($ticket->items()->filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index-items', ['model' => $ticket]);
    }

    /**
     * Show the form for creating a new answer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Ticket $ticket)
    {
        return view('admin.modules.answers.create', [
            'model'  => new Answer,
            'ticket' => $ticket,
        ]);
    }

    /**
     * Store a newly created answer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Ticket $ticket, Request $request)
    {
        // upload files
        if (is_upload_request($request) && $request->has('file')) {
            $this->validateFile($request);
            return $request->user()->uploadFile($request->file, 'files/answers', true);
        }

        // validate
        $data               = $this->validateStore($request);
        $data['creator_id'] = auth()->id();

        // create
        $ticket->items()->create($data);

        // change ticket status to responsed
        $ticket->responsed();

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('tickets.answers.create', ['ticket' => $ticket->id])]);
        }

        return redirect()
            ->route('tickets.answers.create', ['ticket' => $ticket->id])
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified answer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket, Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified answer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket, Answer $answer)
    {
        if (!$answer->is_owner) {
            flash_message('متاسفانه شما مجاز به انجام این عملیات نیستید.', 'error');
            return redirect()->route('tickets.answers.index', ['ticket' => $ticket->id]);
        }

        return view('admin.modules.answers.edit', [
            'model'     => $answer,
            'edit_form' => true,
            'ticket'    => $ticket,
        ]);
    }

    /**
     * Update the specified answer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Ticket $ticket, Answer $answer, Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $answer->update($data);

        success_flash();
        return response(['redirect' => route('tickets.answers.index', ['ticket' => $ticket->id])]);
    }

    /**
     * Remove the specified answer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket, Answer $answer)
    {
        return response([
            'result' => $answer->delete(),
        ]);
    }

    /**
     * Validate the answer store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'body' => 'required|string',
            'file' => 'nullable',
        ]);
    }

    /**
     * Validate the answer update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, Answer $answer)
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
