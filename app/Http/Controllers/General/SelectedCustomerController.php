<?php

namespace App\Http\Controllers\General;

use App\Filters\SelectedCustomerFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\SelectedCustomer\SelectedCustomerCollection;
use App\Models\General\Category;
use App\Models\General\CategoryItem;
use App\Models\General\SelectedCustomer;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SelectedCustomerController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the selected_customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, SelectedCustomerFilters $filters)
    {
        if (request()->expectsJson()) {
            return new SelectedCustomerCollection(SelectedCustomer::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new selected_customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shop_grades             = config('portal.selected_customer.shop_grades');
        $shop_pakhors            = config('portal.selected_customer.shop_pakhors');
        $shop_ownership_status   = config('portal.selected_customer.shop_ownership_status');
        $status                  = config('portal.selected_customer.status');
        $shop_has_sign           = config('portal.selected_customer.shop_has_sign');
        $cooperation_status      = config('portal.selected_customer.cooperation_status');
        $shop_available_products = Category::asGroupOptionForSelectedCustomers(config('portal.selected_customer_module_id'));
        // return $shop_available_products;

        return view('admin.globals.create', [
            'model'                   => new SelectedCustomer,
            'shop_grades'             => $shop_grades,
            'shop_pakhors'            => $shop_pakhors,
            'shop_ownership_status'   => $shop_ownership_status,
            'status'                  => $status,
            'shop_has_sign'           => $shop_has_sign,
            'shop_available_products' => $shop_available_products,
            'cooperation_status'      => $cooperation_status,
        ]);
    }

    /**
     * Store a newly created selected_customer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // upload files
        if (is_upload_request($request) && $request->has('image')) {
            $this->validateFile($request);
            return $request->user()->uploadFile($request->image, 'images/selected_customers', true);
        }

        // validate
        $data = $this->validateStore($request);

        $data['shop_purchase_status'] = [
            'shop_purchase_status_1400' => Arr::pull($data, 'shop_purchase_status_1400'),
            'shop_purchase_status_1401' => Arr::pull($data, 'shop_purchase_status_1401'),
        ];

        // create
        auth()->user()->selected_customers()->create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('selected_customers.index')]);
        }

        return redirect()
            ->route('selected_customers.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified selected_customer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SelectedCustomer $selected_customer)
    {
        //
    }

    /**
     * Show the form for editing the specified selected_customer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SelectedCustomer $selected_customer)
    {
        $shop_grades                    = config('portal.selected_customer.shop_grades');
        $shop_pakhors                   = config('portal.selected_customer.shop_pakhors');
        $shop_ownership_status          = config('portal.selected_customer.shop_ownership_status');
        $status                         = config('portal.selected_customer.status');
        $shop_has_sign                  = config('portal.selected_customer.shop_has_sign');
        $cooperation_status             = config('portal.selected_customer.cooperation_status');
        $shop_available_products        = Category::asGroupOptionForSelectedCustomers(config('portal.selected_customer_module_id'));
        $shop_available_active_products = CategoryItem::whereIn('id', $selected_customer->shop_available_products ?? [])->asOptionForMultiselectForSelectedCustomers();

        return view('admin.globals.edit', [
            'model'                          => $selected_customer,
            'edit_form'                      => true,
            'shop_grades'                    => $shop_grades,
            'shop_pakhors'                   => $shop_pakhors,
            'shop_ownership_status'          => $shop_ownership_status,
            'status'                         => $status,
            'shop_has_sign'                  => $shop_has_sign,
            'shop_available_products'        => $shop_available_products,
            'shop_available_active_products' => $shop_available_active_products,
            'cooperation_status'             => $cooperation_status,
        ]);
    }

    /**
     * Update the specified selected_customer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SelectedCustomer $selected_customer)
    {
        // validate
        $data = $this->validateStore($request);

        $data['shop_purchase_status'] = [
            'shop_purchase_status_1400' => Arr::pull($data, 'shop_purchase_status_1400'),
            'shop_purchase_status_1401' => Arr::pull($data, 'shop_purchase_status_1401'),
        ];

        // create
        $selected_customer->update($data);

        success_flash();
        return response(['redirect' => route('selected_customers.index')]);
    }

    /**
     * Remove the specified selected_customer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SelectedCustomer $selected_customer)
    {
        return response([
            'result' => $selected_customer->delete(),
        ]);
    }

    /**
     * Validate the selected_customer store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        $data = $request->validate([
            'customer_fullname'                        => 'nullable',
            'customer_code'                            => 'nullable',
            'customer_phone'                           => 'nullable',
            'shop_has_sign'                            => 'nullable',
            'shop_address'                             => 'nullable',
            'shop_grade'                               => 'nullable',
            'shop_salesman'                            => 'nullable',
            'shop_manager'                             => 'nullable',
            'shop_region'                              => 'nullable',
            'shop_pakhor'                              => 'nullable',
            'shop_ownership_status'                    => 'nullable',
            'shop_size'                                => 'nullable',
            'shop_shelf_size'                          => 'nullable',
            'shop_shelf_aarrangement_space_size'       => 'nullable',
            'shop_mesh_and_sticker_installation_space' => 'nullable',
            'shop_line_count'                          => 'integer|nullable',
            'shop_available_products.*.id'             => 'nullable|exists:category_items,id',
            'shop_purchase_status_1400'                => 'nullable',
            'shop_purchase_status_1401'                => 'nullable',
            'sales_supervisor_comment'                 => 'nullable',
            'region_supervisor_comment'                => 'nullable',
            'sales_manager_comment'                    => 'nullable',
            'status'                                   => 'nullable',
            'image'                                    => 'nullable',
            'cooperation_status'                       => 'nullable',
        ]);

        return multiselect_adapter($data);
    }

    /**
     * Validate the selected_customer update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, SelectedCustomer $selected_customer)
    {
        return $request->validate([
            //
        ]);
    }

    public function validateFile(Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
    }
}
