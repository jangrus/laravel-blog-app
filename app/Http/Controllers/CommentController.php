<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use function PHPUnit\Framework\isNull;

class CommentController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $request->validate(['content' => ['required', 'string', 'max:255']]);
        //$post->comments()->create([...$data, 'user_id' => $request->user()->id]);

        $data = $request->all();
        $data['header'] = "a";
        $data['user_id'] = Auth::id();
        $data['post_id'] = $post->id;
        $data['parent_post'] = $post->id;
        $data['created_by'] = Auth::id();

        Comment::create($data);
        return to_route('posts.show', $post)->withFragment('comments');
    }

    public function nestedComment(Request $request, Post $post, Comment $comment)
    {
        $data = $request->validate(['content' => ['required', 'string', 'max:255']]);
        $comment->comments()->create([...$data, 'post_id' => $request->input('post_id'), 'user_id' => $request->user()->id]);
        return to_route('posts.show', $post)->withFragment('comments');
    }

    public function userComments()
    {
        return view('posts.show-comments', [
            'comments' => Comment::where('user_id', Auth::id())->get(),
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, Comment $comment)
    {
        if (!Gate::allows('delete', $comment)) {
            return abort(403);
        }

        $comment->delete();

        return to_route('posts.show', $post)->withFragment('comments');
    }
}
