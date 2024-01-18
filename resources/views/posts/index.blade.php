<x-app-layout>
    <div class="max-w-5xl mx-auto py-6 px-2">
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

        <div class="mt-2">

        </div>
    </div>
</x-app-layout>
