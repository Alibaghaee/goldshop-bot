<?php

namespace App\Http\Controllers\Site;

use App\Filters\ContentFiltersSite;
use App\Http\Controllers\Controller;
use App\Models\General\Contact;
use App\Models\General\Content;
use App\Models\General\Menu;
use App\Models\General\MenuItem;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $firstSection = Menu::with('items')->find(3);
        $slider = Menu::with('items')->find(2);
        $newsEvent = Menu::with('items')->find(4);

        $counseling = Menu::with('items')->find(5);
        $contactUs = Menu::with('items')->find(6);
        $publicNotifications = Menu::with('items')->find(8);
        $giveNumber = Menu::with('items')->find(9);
        $serviceBimehBtn = Menu::with('items')->find(10);

        $newsEventItem =  Content::isActive()
            ->publishTime()
            ->whereHas('category_item', function ($q) {
                $q->where('category_id', 22);
            })->orderByDesc('updated_at')
            ->take(20)->get();

        return view(getSiteBladePath('modules.home.index'), compact(
            'giveNumber',
            'newsEventItem',
            'serviceBimehBtn',
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
     * @param Content $content
     */
    public function showMenuItem(Content $content)
    {
        if (!$content->active) {

            return redirect()->back();
        }

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
            'email' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:191',
            'phone' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:10000',
        ]);

        $contact = Contact::make();
        $contact->fullname = $data['fullname'];
        $contact->email = $data['email'] ?? '';
        $contact->mobile = $data['mobile'] ?? '';
        $contact->phone = $data['phone'] ?? '';
        $contact->description = $data['description'] ?? '';
        $contact->ip = $request->ip();
        $contact->save();

        return response(['result' => 'ok']);
    }

    /**
     * Display a listing of the resource according to requested type.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchIndex(ContentFiltersSite $filtersSite)
    {
        $contents = Content::filter($filtersSite)
            ->isActive()
            ->publishTime()
            ->orderByDesc('updated_at')
            ->paginate(24);


        $title = 'اخبار';


        return view(getSiteBladePath('modules.bime.content.search_index'), compact('contents', 'title'));
    }


    /**
     * Display the specified resource.
     *
     * @param Request $request
     */
    public function search(Request $request)
    {


        return response([
            'result' => 'ok',
            'path' => route('search.index', ['local' => 'fa', 'box' => $request->input('search_box','')])]);
    }
}
