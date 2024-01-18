@extends('layouts.app')

@section('title', 'Create Blog Post')

@section('content')
    <h1>Create Blog Post</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <label for="header">Header:</label>
        <input type="text" name="header" id="header" class="form-control" required>
        <br>
        <label for="content">Content:</label>
        <textarea name="content" id="content" class="form-control" required></textarea>
        <br>
        <label for="topic_id">Category:</label>
        <select name="topic_id" id="topic_id" class="form-control" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <br>
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
@endsection
