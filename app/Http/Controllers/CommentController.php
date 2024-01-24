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
        $comment->comments()->create([
            ...$data,
            'post_id' => $post->id,
            'user_id' => $request->user()->id
        ]);
        return to_route('posts.show', $post)->withFragment('comments');
    }

    public function userComments()
    {
        $id = Auth::id();
        return view('profile.comments', [
            'comments' => User::find($id)->comments,
        ]);
    }


    public function myComments()
    {
        return view('mycomments', [
            'comments' => Comment::all(),
        ]);
    }

    public function destroy(Post $post, Comment $comment)
    {
        if (!Gate::allows('delete', $comment)) {
            return abort(403);
        }

        $comment->delete();

        return to_route('posts.show', $post)->withFragment('comments');
    }
}
