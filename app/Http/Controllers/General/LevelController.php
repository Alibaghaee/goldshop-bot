<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\Level\LevelCollection;
use App\Models\General\Level;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LevelController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->expectsJson()) {
            $levels = $this->guard()->user()->getOwnedLevels()->paginate(get_per_page($request));
            return new LevelCollection($levels);
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new Level,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $request->validate([
            'title' => 'required|unique:levels|max:255',
        ]);

        // create
        $this->guard()->user()->createLevel(new Level($data));

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('levels.index')]);
        }

        return redirect()
            ->route('levels.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

/**
 * Display the specified resource.
 *
 * @param  \App\Level  $level
 * @return \Illuminate\Http\Response
 */
    public function show(Level $level)
    {
        //
    }

/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Level  $level
 * @return \Illuminate\Http\Response
 */
    public function edit(Level $level)
    {
        return view('admin.globals.edit', [
            'model'     => $level,
            'edit_form' => false,
        ]);
    }

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Level  $level
 * @return \Illuminate\Http\Response
 */
    public function update(Request $request, Level $level)
    {
        // validate
        $request->validate([
            'title' => "required|unique:levels,title,$level->id,id|max:255",
        ]);

        // update
        $result = $level->update(['title' => $request->title]);

        // response
        if ($result) {
            success_flash();
            return response(['redirect' => route('levels.index')]);
        }

    }

/**
 * Remove the level from storage if its owned by admin who send the request.
 *
 * @param  \App\Level  $level
 * @return \Illuminate\Http\Response
 */
    public function destroy(Level $level)
    {
        $result = $this->guard()->user()
            ->getOwnedLevels()
            ->where('id', $level->id)
            ->delete();

        return response(compact('result'));
    }
}
