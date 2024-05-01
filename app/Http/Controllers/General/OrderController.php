<?php

namespace App\Http\Controllers\General;

use App\Filters\OrderFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderCollection;
use App\Models\General\Order;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the order.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, OrderFilters $filters)
    {
        if (request()->expectsJson()) {
            return new OrderCollection(Order::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new order.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.globals.create', [
        //     'model' => new Order,
        // ]);
    }

    /**
     * Store a newly created order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // // validate
        // $data = $this->validateStore($request);

        // // create
        // Order::create($data);

        // // return response
        // if ($request->wantsJson()) {
        //     success_flash();
        //     return response(['redirect' => route('orders.index')]);
        // }

        // return redirect()
        //     ->route('orders.index')
        //     ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $transportation_type = config('portal.transportation_type');

        return view('admin.globals.edit', [
            'model'               => $order,
            'edit_form'           => true,
            'transportation_type' => $transportation_type,
        ]);
    }

    /**
     * Update the specified order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // validate
        $data = $this->validateUpdate($request);

        // update
        $data = multiselect_adapter($data);
        $order->update($data);

        success_flash();
        return response(['redirect' => route('orders.index')]);
    }

    /**
     * Remove the specified order from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        return response([
            'result' => $order->delete(),
        ]);
    }

    /**
     * Validate the order store request.
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
     * Validate the order update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request)
    {
        return $request->validate([
            'request_info'           => 'required|max:10000',
            'product_type'           => 'required|max:255',
            'packing_type'           => 'required|max:255',
            'weight'                 => 'required|max:255',
            'volume'                 => 'required|max:255',
            'origin'                 => 'required|max:255',
            'destination'            => 'required|max:255',
            'preparation_time'       => 'required|max:255',
            'transportation_type.id' => 'required|in:1,2,3,4',
            'fullname'               => 'required|max:255',
            'mobile'                 => 'required|regex:/^09[0-9]{9}$/i',
        ]);
    }
}
