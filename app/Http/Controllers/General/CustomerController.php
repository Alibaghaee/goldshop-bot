<?php

namespace App\Http\Controllers\General;

use App\Filters\CustomerFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\CustomerCollection;
use App\Models\General\Admin;
use App\Models\General\CategoryItem;
use App\Models\General\Customer;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use AdminGuard;

    private $customer_types;
    private $customer_groups;
    private $how_know_types;
    private $sex;

    public function __construct()
    {
        $this->customer_groups = CategoryItem::asOption(config('portal.customer_groups_category_id'));
        $this->how_know_types  = CategoryItem::asOption(config('portal.how_know_types_category_id'));
        $this->customer_types  = config('portal.customer_types');
        $this->sex             = config('portal.sex');
        $this->admins          = Admin::asOption();
    }

    /**
     * Display a listing of the customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CustomerFilters $filters)
    {
        if (request()->expectsJson()) {
            return new CustomerCollection(Customer::filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['types']  = $this->customer_types;
        $data['options']['groups'] = $this->customer_groups;
        $data['options']['admins'] = $this->admins;

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model'           => new Customer,
            'customer_types'  => $this->customer_types,
            'customer_groups' => $this->customer_groups,
            'how_know_types'  => $this->how_know_types,
            'sex'             => $this->sex,
        ]);
    }

    /**
     * Store a newly created customer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateStore($request);

        auth()->user()->customers()->create($data);

        return $this->redirectToIndex();
    }

    /**
     * Display the specified customer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified customer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $category_items = CategoryItem::AsOptionForMultiselect();

        return view('admin.globals.edit', [
            'model'           => $customer,
            'edit_form'       => true,
            'customer_types'  => $this->customer_types,
            'customer_groups' => $this->customer_groups,
            'how_know_types'  => $this->how_know_types,
            'sex'             => $this->sex,
            'category_items'  => $category_items,
        ]);
    }

    /**
     * Update the specified customer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $data = $this->validateStore($request);

        $customer->update($data);

        return $this->redirectToIndex();
    }

    /**
     * Remove the specified customer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        return response([
            'result' => $customer->delete(),
        ]);
    }

    /**
     * Validate the customer store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        $data = $request->validate([
            'type.id'               => 'required|in:1,2',
            'group_id.id'           => 'nullable',
            'address'               => 'string|nullable',
            'postal_code'           => 'string|nullable',
            'email'                 => 'string|nullable',
            'phone'                 => 'string|nullable',
            'fax'                   => 'string|nullable',
            'website'               => 'string|nullable',
            'how_know_id.id'        => 'nullable',
            'company_name'          => 'required_if:type.id,2|nullable',
            'economic_code'         => 'string|nullable',
            'company_national_code' => 'string|nullable',
            'register_id'           => 'string|nullable',
            'name'                  => 'required_if:type.id,1|nullable',
            'family'                => 'required_if:type.id,1|nullable',
            'mobile'                => 'string|nullable',
            'father_name'           => 'string|nullable',
            'national_code'         => 'string|nullable',
            'id_number'             => 'string|nullable',
            'place'                 => 'string|nullable',
            'sex.id'                => 'nullable|in:0,1',
            'birth_date'            => 'nullable|date',
        ]);

        return multiselect_adapter($data);
    }

    /**
     * Validate the customer update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, Customer $customer)
    {
        return $request->validate([
            //
        ]);
    }

    private function redirectToIndex()
    {
        success_flash();
        return response(['redirect' => route('customers.index')]);
    }
}
