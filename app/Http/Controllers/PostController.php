<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

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
        $category = Category::all();
        return view('posts.create', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'header' => 'required',
            'content' => 'required',
            'topic_id' => 'required|exists:category,id',
        ]);

        $postData = $request->all();
        $postData['created_by'] = auth()->id();

        Post::create($postData);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'comments' => $post->comments()->latest()->with('user')->paginate(10),
        ]);
    }
}
