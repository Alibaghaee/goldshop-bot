<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\Level;
use App\Models\General\Module;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items    = Module::select('title', 'id')->get();
        $endpoint = route('facilities.index');
        return view('admin.globals.sort', compact('items', 'endpoint'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'items_data.*.id' => 'exists:modules,id',
        ]);

        foreach ($request->items_data as $key => $item) {
            Module::findOrFail($item['id'])->update(['order' => ++$key]);
        }

        success_flash();
        \Cache::flush();
        return response(['redirect' => route('facilities.index')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id level id
     * @return \Illuminate\Http\Response
     */
    public function edit($level_id)
    {
        if (!$this->guard()->user()->getOwnedLevels()->where('id', $level_id)->count()) {
            return abort(403);
        }
        $level          = Level::findOrFail($level_id);
        $active_actions = $level->actions->pluck('id')->toArray();
        $modules        = $level->admin->level->Modules();

        return view('admin.modules.facilities.edit',
            compact('modules', 'level_id', 'active_actions')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $level            = Level::findOrFail($id);
        $selected_actions = $level->validateSelectedActionsId($request->selected_actions);
        $level->actions()->sync($selected_actions);

        success_flash();
        \Cache::flush();
        return response(['redirect' => route('levels.index')]);
    }
}
