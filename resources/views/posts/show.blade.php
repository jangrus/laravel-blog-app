<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="max-w-5xl mx-auto px-2 py-6">
                        <div>
                            <h1 class="text-3xl font-semibold text-gray-300">{{ $post->header }}</h1>
                            <span class="text-sm text-gray-500">
                {{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}
            </span>
                        </div>

                        <div class="prose mt-6 text-gray-300">
                            {!! $post->html !!}
                        </div>

                        <div class="mt-12 text-gray-300">
                            <h2 id="comments" class="text-2xl font-semibold">Comments</h2>

                            @auth
                                <form action="{{ route('posts.comments.store', $post) }}" method="post" class="mt-2">
                                    @csrf

                                    <textarea name="content" id="content" cols="30" rows="5" class="w-full bg-gray-800"></textarea>
                                    <x-primary-button type="submit">Add Comment</x-primary-button>
                                </form>
                            @endauth
                            @include('posts.show-comments', ['comments' => $comments])
                            <div class="mt-2">
                                {{ $comments->fragment('comments')->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
