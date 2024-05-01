<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\RechargeWalletRequest;
use App\Models\General\Contact;
use App\Models\General\Menu;
use App\Models\General\MenuItem;
use App\Models\General\Product;
use App\Models\General\ProductItem;
use App\Models\General\Purchase;
use App\Rules\Mobile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource according to requested type.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $category_id, $category_item_id = null)
    {

        $user = auth()->user();

        $firstSection = Menu::with('items')->find(3);
        $slider = Menu::with('items')->find(2);
        $newsEvent = Menu::with('items')->find(4);
        $counseling = Menu::with('items')->find(5);
        $contactUs = Menu::with('items')->find(6);
        $publicNotifications = Menu::with('items')->find(8);


        return view(getSiteBladePath('modules.dashboard.index'), compact(
            'user',
            'slider',
            'firstSection',
            'newsEvent',
            'counseling',
            'contactUs',
            'publicNotifications',
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param MenuItem $item
     */
    public function showMenuItem(MenuItem $item)
    {

        if (!$item->active) {

            return redirect()->back();
        }
        $content = $item;
        return view(getSiteBladePath('modules.bime.content.showMenuItem'), compact('content'));
    }


    /**
     * Display the specified resource.
     *
     * @param Request $request
     */
    public function contactUs(Request $request)
    {

        $data = $request->validate([
            'fullname' => 'required|string|max:191',
            'email' => 'required|string|max:255',
            'mobile' => 'nullable|string|max:191',
            'phone' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:10000',
        ]);

        $contact = Contact::make();
        $contact->fullname = $data['fullname'];
        $contact->email = $data['email'] ?? '';
        $contact->mobile = $data['mobile']??'';
        $contact->phone = $data['phone'] ?? '';
        $contact->description = $data['description'] ?? '';
        $contact->ip = $request->ip();
        $contact->save();

        return response(['result' => 'ok']);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     */
    public function search(Request $request)
    {
        $data = $request->validate([
            'search_box' => 'required|string|max:500',
        ]);

        return response([
            'result' => 'ok',
            'path' => route('page.index', ['local' => 'fa', 'search_box' => $data['search_box']])]);
    }
}
