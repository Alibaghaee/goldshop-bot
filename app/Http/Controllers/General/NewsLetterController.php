<?php

namespace App\Http\Controllers\General;

use App\Filters\DriverFilters;
use App\Filters\NewsLetterFilters;
use App\Filters\UserFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Driver\DriverResourceCollection;
use App\Http\Resources\NewsLetter\NewsLetterCollection;
use App\Http\Resources\NewsLetter\NewsLetterUserResourceCollection;
use App\Models\General\Driver;
use App\Traits\Controllers\AdminGuard;
use App\Models\General\NewsLetter;
use App\Models\User;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the news_letter.
     *
     * @return \Illuminate\View\View|NewsLetterCollection
     */
    public function index(Request $request, NewsLetterFilters $filters)
    {
        if (request()->expectsJson()) {
            return new NewsLetterCollection(NewsLetter::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new news_letter.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, UserFilters $filters)
    {
        if (request()->expectsJson()) {

            return new NewsLetterUserResourceCollection(User::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.modules.news_letters.form_create', [
            'model' => new NewsLetter,
        ]);
    }

    /**
     * Show the form for creating a new news_letter.
     *
     * @return \Illuminate\Http\Response
     */
    public function createForDrivers(Request $request, DriverFilters $filters)
    {
        if (request()->expectsJson()) {

            return new DriverResourceCollection(Driver::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.modules.news_letters.form_create_for_drivers', [
            'model' => new NewsLetter,
        ]);
    }

    /**
     * Store a newly created news_letter in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);


        // create
        $newsLetter = NewsLetter::create(['message' => $data['message']]);
        $newsLetter->users()->attach(json_decode($data['user_ids']));


        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response([
                'result' => true,
                'message' => 'با موفقیت ایجاد شد.'
            ]);

        }

        return redirect()
            ->route('news_letters.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }


    /**
     * Store a newly created news_letter in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeForDrivers(Request $request)
    {
        // validate

        $data = $this->validateDriversStore($request);

        // create
        $newsLetter = NewsLetter::create(['message' => $data['message']]);
        $newsLetter->drivers()->attach(json_decode($data['driver_ids']));


        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response([
                'result' => true,
                'message' => 'با موفقیت ایجاد شد.'
            ]);

        }

        return redirect()
            ->route('news_letters.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified news_letter.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(NewsLetter $news_letter)
    {
        //
    }

    /**
     * Show the form for editing the specified news_letter.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsLetter $news_letter)
    {
        return view('admin.globals.edit', [
            'model' => $news_letter,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified news_letter in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewsLetter $news_letter)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        $news_letter->update($data);

        success_flash();
        return response(['redirect' => route('news_letters.index')]);
    }

    /**
     * Remove the specified news_letter from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsLetter $news_letter)
    {
        return response([
            'result' => $news_letter->delete(),
        ]);
    }

    /**
     * Validate the news_letter store request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'user_ids' => 'required',
            'message' => 'required',
        ]);
    }

    /**
     * Validate the news_letter store request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateDriversStore(Request $request)
    {
        return $request->validate([
            'driver_ids' => 'required',
            'message' => 'required',
        ]);
    }

    /**
     * Validate the news_letter update request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateUpdate(Request $request, NewsLetter $news_letter)
    {
        return $request->validate([
            //
        ]);
    }
}
