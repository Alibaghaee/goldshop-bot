<?php

namespace App\Http\Controllers\Site;

use App\Filters\ContentFiltersSite;
use App\Http\Controllers\Controller;

use App\Models\General\Category;
use App\Models\General\Content;
use App\Models\General\Menu;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource according to requested type.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContentFiltersSite $filtersSite)
    {
        $contents = Content::filter($filtersSite)
            ->isActive()
            ->publishTime()
            ->whereHas('category_item', function ($q) {
                $q->where('category_id', 22);
            })->orderByDesc('updated_at')
            ->paginate(6);

        $populars = Content::mostVisited(4, true);
        $title = 'اخبار';

        $categories = Category::asGroupOption(config('portal.content_module_id'),22);


        return view(getSiteBladePath('modules.bime.content.news_index'), compact('contents', 'title', 'populars', 'categories'));
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {

        if (!($content->active &&
            ((is_null($content->publish_date) || $content->publish_date <= now())) &&
            ((is_null($content->expire_date) || $content->expire_date >= now()))
        )) {
            abort(403);
        }

        $content->increment('views');

        $content->load('publishedComments.publishedComments');

        $populars = Content::mostVisited(4, true);
        $replySlug = 'پاسخ به ';
        $socialMedia = Menu::with('items')->find(13);

//        $like = $content->like()->firstOrCreate([]);

        return view(getSiteBladePath('modules.bime.content.show'), compact('content', 'populars', 'replySlug', 'socialMedia'));
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function showMenu(Content $content)
    {

        if (!($content->active &&
            ((is_null($content->publish_date) || $content->publish_date <= now())) &&
            ((is_null($content->expire_date) || $content->expire_date >= now()))
        )) {
            abort(403);
        }


        $content->increment('views');


        $socialMedia = Menu::with('items')->find(13);



        return view(getSiteBladePath('modules.bime.content.showMenu'), compact('content', 'socialMedia'));
    }


    public function storeComment(Request $request, $locale, Content $content)
    {

        $data = $this->validateCommentStore($request);


        if (auth('web')->check()) {
            $userData = ['user_id' => auth('web')->id()];
        } else {

            $userData = ['admin_id' => auth('admin')->id()];
        }

        $content->comments()->create($data + $userData);


        return redirect()->back()->with('success', 'دیدگاه شما با موفقیت ثبت شد');
    }


    public function storeGuestComment(Request $request, $locale, Content $content)
    {

        $data = $this->validateGuestCommentStore($request);


        $content->comments()->create($data);


        return redirect()->back()->with('success', 'دیدگاه شما با موفقیت ثبت شد');
    }


    protected function validateCommentStore(Request $request)
    {
        return $request->validate([
            'description' => 'required|string|min:2|max:100000',
        ]);
    }

    protected function validateGuestCommentStore(Request $request)
    {
        return $request->validate([
            'guest_name' => 'required|string|min:2|max:5000',
            'description' => 'required|string|min:2|max:100000',
        ]);
    }


}
