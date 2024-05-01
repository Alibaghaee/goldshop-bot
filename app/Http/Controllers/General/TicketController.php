<?php

namespace App\Http\Controllers\General;

use App\Filters\TicketFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Ticket\TicketCollection;
use App\Models\General\Admin;
use App\Models\General\Ticket;
use App\Notifications\TicketCreateNotification;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the ticket.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, TicketFilters $filters)
    {
        if (request()->expectsJson()) {
            return new TicketCollection(Ticket::isTicket()->withCount('items')->filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['status'] = config('portal.ticket_status');

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new ticket.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admins = Admin::where('id', '!=', auth()->id())->asOption();

        return view('admin.globals.create', [
            'model'  => new Ticket,
            'admins' => $admins,
            'status' => config('portal.ticket_status'),
        ]);
    }

    /**
     * Store a newly created ticket in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // upload files
        if (is_upload_request($request) && $request->has('file')) {
            $this->validateFile($request);
            return $request->user()->uploadFile($request->file, 'files/tickets', true);
        }

        // validate
        $data = $this->validateStore($request);

        // create
        $ticket = auth()->user()->tickets()->create($data);
        auth()->user()->notify(new TicketCreateNotification($ticket));

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('tickets.index')]);
        }

        return redirect()
            ->route('tickets.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified ticket.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified ticket.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $admins = Admin::asOption();

        return view('admin.globals.edit', [
            'model'     => $ticket,
            'edit_form' => true,
            'admins'    => $admins,
            'status'    => config('portal.ticket_status'),
        ]);
    }

    /**
     * Update the specified ticket in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $ticket->update($data);

        success_flash();
        return response(['redirect' => route('tickets.index')]);
    }

    /**
     * Remove the specified ticket from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        return response([
            'result' => $ticket->delete(),
        ]);
    }

    /**
     * Validate the ticket store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        $data = $request->validate([
            'receiver_id.id' => 'required|exists:admins,id',
            'title'          => 'required|string|max:255',
            'body'           => 'required|string',
            'file'           => 'nullable',
            'status.id'      => 'nullable|in:0,1,2,3,4',
        ]);

        return multiselect_adapter($data);
    }

    /**
     * Validate the ticket update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, Ticket $ticket)
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
