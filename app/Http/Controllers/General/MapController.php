<?php

namespace App\Http\Controllers\General;

use App\Events\NetworkActivityEvent;
use App\Filters\MapCloneFilters;
use App\Filters\MapFilters;
use App\Filters\NetworkActivityFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Map\MapCollection;
use App\Http\Resources\MapClone\MapCloneCollection;
use App\Http\Resources\NetworkActivity\NetworkActivityCollection;
use App\MapClone;
use App\Models\General\Category;
use App\Models\General\CategoryItem;
use App\Models\General\Map;
use App\NetworkActivity;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MapController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the map.
     *
     * @return \Illuminate\View\View|MapCollection
     */
    public function index(Request $request, MapFilters $filters)
    {
        // $this->insertData();

        if (request()->expectsJson()) {
            return (new MapCollection(Map::filter($filters)->paginate(get_per_page($request))))
                ->additional(['meta' => [
                    'params' => $request->all()
                ]]);

        }
        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new map.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new Map,
            'promotionalItems' => config('portal.promotional_items'),
            'shop_available_products' => Category::asGroupOptionForSelectedCustomers(config('portal.selected_customer_module_id'))

        ]);
    }

    /**
     * Store a newly created map in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if (is_upload_request($request) && $request->hasAny(['image', 'cerline_image'])) {
            $this->validateFile($request);


            $images = $request->only([
                'image',
                'cerline_image'
            ]);

            foreach ($images as $image) {


                return $request->user()->uploadFile($image, 'images/map', true);
            }
        }

        // validate
        $data = $this->validateStore($request);
        $data['promotional_available_item'] = $request->promotional_available_item;
        $data['shop_available_products'] = $request->shop_available_products;
        $data['promotional_available_item_values'] = $this->givePromotionalValue($request);

        // create
        Map::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('maps.index')]);
        }

        return redirect()
            ->route('maps.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified map.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Map $map)
    {
        //
    }

    /**
     * Display the specified mapClone.
     *
     * @param MapClone $mapClone
     * @return \Illuminate\View\View
     */
    public function showClone(MapClone $mapClone)
    {

        return view('admin.modules.maps.edit', [
            'model' => $mapClone,
            'isClone' => true,
            'cloneAddress' => 'admin.modules.maps.clone_form',
            'edit_form' => true,
            'isDisabled' => true,
            'promotionalItems' => config('portal.promotional_items'),
            'shop_available_products' => Category::asGroupOptionForSelectedCustomers(config('portal.selected_customer_module_id')),
            'shop_available_active_products' => CategoryItem::whereIn('id', $selected_customer->shop_available_products ?? [])->asOptionForMultiselectForSelectedCustomers(),
        ]);
    }

    /**
     * Show the form for editing the specified map.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit(Map $map)
    {

        return view('admin.modules.maps.edit', [
            'model' => $map,
            'edit_form' => true,
            'promotionalItems' => config('portal.promotional_items'),
            'shop_available_products' => Category::asGroupOptionForSelectedCustomers(config('portal.selected_customer_module_id')),
            'shop_available_active_products' => CategoryItem::whereIn('id', $selected_customer->shop_available_products ?? [])->asOptionForMultiselectForSelectedCustomers(),
        ]);
    }

    /**
     * Update the specified map in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Map $map)
    {

        if (is_upload_request($request) && $request->hasAny(['image', 'cerline_image'])) {
            $this->validateFile($request);


            $images = $request->only([
                'image',
                'cerline_image'
            ]);

            foreach ($images as $image) {


                return $request->user()->uploadFile($image, 'images/map', true);
            }
        }


        // validate
        $data = $this->validateStore($request);

        $data['promotional_available_item'] = $request->promotional_available_item;
        $data['shop_available_products'] = $request->shop_available_products;
        $data['promotional_available_item_values'] = $this->givePromotionalValue($request);

        // create
        $map->update($data);
        $map->touch();

        if ($map->wasChanged([
                'code',
                'region',
                'address',
                'location_x',
                'location_y',
                'color',
                'mesh',
                'banner',
                'cerline',
                'visitor',
                'visit_date',
                'installer',
                'install_date',
                'data',
                'image',
                'cerline_image',
                'promotional_available_item',
                'shop_available_products',
                'promotional_available_item_values',
            ]) || $map->location->wasChanged(['lat_long'])) {

            event(new NetworkActivityEvent($map, auth()->user(), 'فروشگاه'));
        }


        success_flash();
        return response(['redirect' => route('maps.index')]);
    }

    /**
     * Remove the specified map from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Map $map)
    {
        return response([
            'result' => $map->delete(),
        ]);
    }

    /**
     * ForceDelete the specified map from storage.
     *
     * @param int $map
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(int $map)
    {
        return response([
            'result' => Map::onlyTrashed()
                ->where('id', $map)
                ->firstOrFail()
                ->forceDelete(),
        ]);
    }

    /**
     * Restore the specified map from storage.
     *
     * @param int $map
     * @return \Illuminate\Http\Response
     */
    public function restore(int $map)
    {

        return response([
            'result' => Map::onlyTrashed()
                ->where('id', $map)
                ->firstOrFail()
                ->restore(),
        ]);
    }


    /**
     * @param Request $request
     * @param Map $map
     * @return \Illuminate\Http\Response
     **/
    public function sendLocation(Request $request, Map $map)
    {
        $numbers = array_map('trim', explode(',', $request->input('list', '')));
        $numbers = array_flip(array_merge(array_flip($numbers)));
        $numbers = array_values($numbers);


        $message =
            "کد فروشگاه: " .
            $map->code .
            ' آدرس :' .
            $map->address .
            'لینک:' .
            $map->neshan_map_uri;
        foreach ($numbers as $number) {
            if (filter_var( preg_match('/^09\d{9}$/',$number), FILTER_VALIDATE_BOOLEAN)){

                sms($number, $message);
            }
        }

        return response([
            'result' => true,
            'message' => 'عملیات با موفقیت انجام شد.'
        ]);
    }


    /**
     * Validate the map store request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'code' => 'string|nullable',
            'region' => 'string|nullable',
            'address' => 'string|nullable',
            'location_x' => 'string|nullable',
            'location_y' => 'string|nullable',
            'color' => 'string|nullable',
            'mesh' => 'nullable',
            'banner' => 'nullable',
            'cerline' => 'nullable',
            'visitor' => 'string|nullable',
            'visit_date' => 'string|nullable',
            'installer' => 'string|nullable',
            'install_date' => 'string|nullable',
            'data' => 'string|nullable',
            'image' => 'string|nullable',
            'cerline_image' => 'string|nullable',

            'promotional_available_item' => 'nullable',
            'shop_available_products.*.id' => 'nullable|exists:category_items,id',
        ]);
    }

    /**
     * Validate the map update request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateUpdate(Request $request, Map $map)
    {
        return $request->validate([
            //
        ]);
    }

    public function validateFile(Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpeg,jpg,bmp,png',
            'cerline_image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
    }

    private function insertData()
    {
        function modify_date($var)
        {
            if (empty($var)) {
                return $var;
            }
            $var = explode('/', $var);
            $var[1] = strlen($var[1]) == 1 ? '0' . $var[1] : $var[1];
            $var[2] = strlen($var[2]) == 1 ? '0' . $var[2] : $var[2];
            $var = implode('/', $var);
            return $var;
        }

        ;

        // return \Morilog\Jalali\Jalalian::fromFormat('Y/m/d', modify_date('1401/2/1'))->toCarbon()->toDateTimeString();
        $shops = config('shops');
        foreach ($shops as $key => $shop) {
            $shop = explode('|', $shop);
            $shop = array_map('trim', $shop);
            $shop[2] = !empty($shop[2]) ? \Morilog\Jalali\Jalalian::fromFormat('Y/m/d', modify_date($shop[2]))->toCarbon()->toDateTimeString() : null;
            $shop[4] = !empty($shop[4]) ? \Morilog\Jalali\Jalalian::fromFormat('Y/m/d', modify_date($shop[4]))->toCarbon()->toDateTimeString() : null;
            $shop[7] = explode(', ', $shop[7]);
            $shops[$key] = $shop;
        }

        foreach ($shops as $shop) {
            Map::forceCreate([
                'code' => $shop[0],
                'region' => $shop[1],
                'address' => $shop[6],
                'location_x' => $shop[7][0],
                'location_y' => $shop[7][1],
                // 'color'        => '',
                // 'mesh'         => '',
                // 'banner'       => '',
                // 'cerline'      => '',
                'visitor' => $shop[3],
                'visit_date' => $shop[2],
                'installer' => $shop[5],
                'install_date' => $shop[4],
                // 'data'         => '',
                'image' => '/storage/images/map/' . $shop[0] . '.jpg',
            ]);
        }

        return $shops;
    }


    private function givePromotionalValue($request)
    {
        $promotional_available_item_values = collect();
        collect($request->all())->each(function ($value, $key) use ($promotional_available_item_values) {


            if (Str::contains($key, 'promotional_available_item_ids')) {


                $promotional_available_item_values->push(['id' => explode('.', $key)[1], 'value' => $value]);
            }
        });

        return $promotional_available_item_values->toArray();
    }


    /**
     * Display the specified admin_profile.
     *
     * @param Map $map
     * @param Request $request
     * @param MapCloneFilters $filters
     * @return \Illuminate\View\View|MapCloneCollection
     */
    public function indexClone(Request $request, MapCloneFilters $filters, Map $map)
    {
        if (request()->expectsJson()) {

            return new MapCloneCollection(
                MapClone::
                with('networkActivity')
                    ->filter($filters)
                    ->where('map_id', $map->id)
                    ->orderByDesc('created_at')
                    ->paginate(get_per_page($request)));
        }

        return view('admin.modules.maps.show_activities'
            , [
                'model' => $map,
                'page_title' => 'لیست تغییرات فروشگاه'
            ]
        );
    }
}
