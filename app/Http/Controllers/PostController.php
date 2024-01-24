<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::all(),
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'header' => 'required',
            'content' => 'required',
            'topic_id' => 'required|exists:categories,id',
        ]);

        $postData = $request->all();
        $postData['user_id'] = Auth::id();
        $postData['created_by'] = Auth::id();

        $post = Post::create($postData);

        return view('posts.show', [
            'post' => $post,
            'comments' => $post->comments()->latest()->with('user')->paginate(10),
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'comments' => $post->comments()->latest()->with('user')->paginate(10),
        ]);
    }

    public function userPosts()
    {
        $id = Auth::id();
        return view('posts.index', [
            'posts' => User::find($id)->posts,
        ]);
    }

    public function likePost(Request $request)
    {
        $like = Like::where([
            ['post_id', $request->postId],
            ['user_id', Auth::id()],
        ])->get();

        if($like->count() > 0){
            $like->first()->update([
                'value' => $request->value
            ]);
            return view('posts.show', [
                'post' => Post::find($request->postId),
                'comments' => Post::find($request->postId)->comments()->latest()->with('user')->paginate(10),
            ]);
        }

        $data['post_id'] = $request->postId;
        $data['user_id'] = Auth::id();
        $data['value'] = $request->value;

        Like::create($data);
        return view('posts.show', [
            'post' => Post::find($request->postId),
            'comments' => Post::find($request->postId)->comments()->latest()->with('user')->paginate(10),
        ]);
    }

}
