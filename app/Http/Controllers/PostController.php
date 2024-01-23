<?php

namespace App\Http\Controllers;

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
            'posts' => Post::latest()->with('user')->paginate(10),
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

        Post::create($postData);
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
}
