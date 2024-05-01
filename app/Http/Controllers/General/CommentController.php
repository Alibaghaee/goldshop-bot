<?php

namespace App\Http\Controllers\General;

use App\Filters\CommentFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\CommentCollection;
use App\Traits\Controllers\AdminGuard;
use App\Models\General\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use AdminGuard;

    /**
     * Display a listing of the comment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CommentFilters $filters)
    {
        if (request()->expectsJson()) {
            return new CommentCollection(Comment::filter($filters)->paginate(get_per_page($request)));
        }

        $data['options']['status'] = Comment::$STATUS_LIST;

        return view('admin.globals.index', compact('data'));
    }

    /**
     * Show the form for creating a new comment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.globals.create', [
            'model' => new Comment,
        ]);
    }

    /**
     * Store a newly created comment in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $data = $this->validateStore($request);

        // create
        Comment::create($data);

        // return response
        if ($request->wantsJson()) {
            success_flash();
            return response(['redirect' => route('comments.index')]);
        }

        return redirect()
            ->route('comments.index')
            ->with('flash', 'با موفقیت ثبت شد.');
    }

    /**
     * Display the specified comment.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified comment.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        $comment->load('commentable');

        return view('admin.globals.edit', [
            'model' => $comment,
            'edit_form' => true,
        ]);
    }

    /**
     * Update the specified comment in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {


        // validate
        $data = $this->validateStore($request);


        if (isset($data['reply']) && (!is_null($data['reply']))) {

            if ($comment->comments()->exists()) {

                $comment->comments()->first()->update([
                    'description' => $data['reply'],
                    'status' => 'published',
                    'admin_id' => auth()->id(),
                ]);
            } else {


                $comment->comments()->create([
                    'description' => $data['reply'],
                    'status' => 'published',
                    'admin_id' => auth()->id(),
                ]);
            }
        }

        unset($data['reply']);
        if (is_array($data['status'])) {


            if (array_key_exists('id', $data['status'])) {

                $data['status'] = $data['status']['id'];
                // create
                $comment->update($data);
                success_flash();
            }
        }


        return response(['redirect' => route('comments.index')]);
    }

    /**
     * Remove the specified comment from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        return response([
            'result' => $comment->delete(),
        ]);
    }

    /**
     * Validate the comment store request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateStore(Request $request)
    {
        return $request->validate([
            'description' => 'required|string',
            'status' => 'required',
            'reply' => 'nullable|min:3',

        ]);
    }

    /**
     * Validate the comment update request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validateUpdate(Request $request, Comment $comment)
    {
        return $request->validate([
            //
        ]);
    }
}
