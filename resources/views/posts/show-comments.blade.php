<ul class="divide-y mt-4">
    @foreach($comments as $comment)
        <div class="display-comment">
        <li class="py-4 px-2 text-gray-300">
            <p>{{ $comment->content }}</p>
            <span class="text-sm text-gray-600">
                {{ $comment->created_at->diffForHumans() }} by {{ $comment->user->name }}
            </span>
            @auth
                <form action="{{ route('comment.comment',['post' => $post, 'comment' => $comment]) }}" method="post" class="mt-2">
                    @csrf

                    <textarea name="content" id="content" cols="10" rows="1" class="w-full bg-gray-800 b"></textarea>
                    <x-primary-button type="submit">Add Comment</x-primary-button>
                </form>
            @endauth
            @can('delete', $comment)
                <form
                    action="{{ route('posts.comments.destroy', ['post' => $post, 'comment' => $comment]) }}"
                    method="post" class="mt-2">
                    @csrf
                    @method('DELETE')

                    <x-danger-button type="submit">Delete</x-danger-button>
                </form>
            @endcan
        </li>
        @include('posts.show-comments', ['comments' => $comment->comments])
        </div>
    @endforeach
</ul>
