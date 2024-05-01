<?php

namespace App\Http\Controllers\General;

use App\Filters\PrizeFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Prize\PrizeCollection;
use App\Models\General\Prize;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class PrizeController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the prize.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PrizeFilters $filters)
    {
        if (request()->expectsJson()) {
            return new PrizeCollection(Prize::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new prize.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new Prize,
        ]);
    }

    /**
     * Store a newly created prize in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        Prize::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('prizes.index')]);
        }

        return redirect()
            ->route('prizes.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified prize.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Prize $prize)
    {
        //
    }

    /**
     * Show the form for editing the specified prize.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Prize $prize)
    {
        return view('admin.globals.edit', [
            'model'     => $prize,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified prize in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prize $prize)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $prize->update($data);

        success_flash();
        return response(['redirect' => route('prizes.index')]);
    }

    /**
     * Remove the specified prize from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prize $prize)
    {
        return response([
            'result' => $prize->delete(),
        ]);
    }

    /**
     * Validate the prize store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'title'       => 'required|max:255',
            'description' => 'nullable',
        ]);
    }

    /**
     * Validate the prize update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, Prize $prize)
    {
        return $request->validate([
            //
        ]);
    }
}
