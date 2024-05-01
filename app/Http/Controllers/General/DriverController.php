<?php

namespace App\Http\Controllers\General;

use App\Filters\DriverFilters;
use App\Filters\TravelFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Driver\DriverCollection;
use App\Http\Resources\Travel\TravelCollection;
use App\Models\General\Travel;
use App\Traits\Controllers\AdminGuard;
use App\Models\General\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the driver.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, DriverFilters $filters)
    {
        if (request()->expectsJson()) {
            return new DriverCollection(Driver::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new driver.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.globals.create', [
            'model' => new Driver,
        ]);
    }

    /**
     * Store a newly created driver in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);
        $data['status'] = $data['status']['id'];

        // create
        Driver::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('drivers.index')]);
        }

        return redirect()
            ->route('drivers.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified driver.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified driver.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        return view('admin.globals.edit', [
            'model' => $driver,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified driver in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        // validate
        $data = $this->validateStore($request);
        $data['status'] = $data['status']['id'];
        // create
        $driver->update($data);

        success_flash();
        return response(['redirect' => route('drivers.index')]);
    }

    /**
     * Remove the specified driver from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        return response([
            'result' => $driver->delete(),
        ]);
    }


    public function indexAsOption()
    {
//        var_dump(Driver::asOption());
        if (request()->expectsJson()) {


            return Driver::where('status', 'enable')->asOption();
        }

        return view('admin.globals.index');
    }


    /**
     * Validate the driver store request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'organization_code' => 'nullable',
            'mobile' => 'nullable',
            'email' => 'nullable',
            'password' => 'nullable',
            'status' => 'nullable',
            'gender' => 'nullable',
            'address' => 'nullable',
            'postal_code' => 'nullable',
        ]);
    }


    /**
     *Index of specific travels
     **/
    public function showTravels(Request $request, TravelFilters $filters, Driver $driver)
    {
        if (request()->expectsJson()) {
            return new TravelCollection(Travel::with('driver', 'user')
                ->filter($filters)
                ->where('driver_id', $driver->id)
                ->paginate(get_per_page($request)));
        }
        $data['options']['status_list'] = Travel::$STATUS_LIST;
        $data['options']['reason_list'] = Travel::$TRAVEL_REASON_LIST;


        return view('admin.modules.drivers.travels'
            , [
                'model' => $driver,
                'page_title' => 'لیست سفرها',
                'data'=>$data
            ]
        );
    }

    /**
     * Validate the driver update request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateUpdate(Request $request, Driver $driver)
    {
        return $request->validate([
            //
        ]);
    }
}
