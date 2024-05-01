<?php

namespace App\Http\Controllers\General;

use App\Filters\TagFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Tag\TagCollection;
use App\Models\General\Tag;
use App\Traits\Controllers\AdminGuard;
use Illuminate\Http\Request;

class TagController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the tag.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, TagFilters $filters)
    {
        if (request()->expectsJson()) {
            return new TagCollection(Tag::filter($filters)->paginate(get_per_page($request)));
        }

        return view('admin.globals.index');
    }

    /**
     * Show the form for creating a new tag.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new Tag,
        ]);
    }

    /**
     * Store a newly created tag in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data         = $this->validateStore($request);
        $data['slug'] = make_slug($data['title']);

        // create
        $tag = Tag::create($data);

        // return response for multiselect tag creation
        if ($request->wantsJson() && $request->has('type')) {
            return response(['id' => $tag->id]);
        }

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('tags.index')]);
        }

        return redirect()
            ->route('tags.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified tag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified tag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.globals.edit', [
            'model'     => $tag,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified tag in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        // validate
        $data         = $this->validateUpdate($request, $tag);
        $data['slug'] = make_slug($data['title']);

        // create
        $tag->update($data);

        success_flash();
        return response(['redirect' => route('tags.index')]);
    }

    /**
     * Remove the specified tag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        return response([
            'result' => $tag->delete(),
        ]);
    }

    /**
     * Validate the tag store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'title' => 'required|max:255|unique:tags,title,null,null',
        ]);
    }

    /**
     * Validate the tag update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateUpdate(Request $request, Tag $tag)
    {
        return $request->validate([
            'title' => "required|max:255|unique:tags,title,$tag->id,id",
        ]);
    }
}
