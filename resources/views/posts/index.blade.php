<x-app-layout>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <ul class="divide-y">
                    @foreach($posts as $post)
                        <li class="py-6 px-2 ">
                            <a href="{{ route('posts.show', $post) }}" class="text-xl font-semibold block text-gray-500">{{ $post->header }}</a>
                            <span class="text-sm text-gray-600">
                                {{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
