<?php

namespace App\Http\Controllers\General;

use App\Filters\RoomFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Room\RoomCollection;
use App\Models\General\Room;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the room.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, RoomFilters $filters)
    {
        if (request()->expectsJson()) {
            return new RoomCollection(Room::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new room.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new Room,
        ]);
    }

    /**
     * Store a newly created room in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        Room::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('rooms.index')]);
        }

        return redirect()
            ->route('rooms.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified room.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified room.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('admin.globals.edit', [
            'model'     => $room,
            'edit_form' => false,
        ]);
    }

    /**
     * Update the specified room in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $room->update($data);

        success_flash();
        return response(['redirect' => route('rooms.index')]);
    }

    /**
     * Remove the specified room from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        return response([
            'result' => $room->delete(),
        ]);
    }

    /**
     * Validate the room store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'title' => 'required|string',
        ]);
    }
}
