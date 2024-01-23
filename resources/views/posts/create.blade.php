<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <ul class="divide-y">
                        <h1 style="font-weight: bold">Create Blog Post</h1>
                        <br>
                        @if(session('success'))
                            <p style="color: green;">{{ session('success') }}</p>
                        @endif

                        <form action="{{ route('posts.store') }}" method="POST">
                            @csrf
                            <div>
                                <x-input-label for="header" :value="__('Header')" />
                                <x-text-input id="header" class="block mt-1 w-full" type="text" name="header" :value="old('header')" required autofocus autocomplete="header" />
                            </div>

                            <!-- Surname -->
                            <div class="mt-4">
                                <x-input-label for="content" :value="__('Content')" />
                                <x-text-input id="content" class="block mt-1 w-full" type="text" name="content" :value="old('content')" required autofocus autocomplete="content" />
                                <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                            </div>
                            <x-input-label for="category" :value="__('Category')" />
                            <select name="topic_id" id="topic_id" class="form-control" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <br>
                            <br>
                            <x-primary-button type="submit" class="btn btn-primary">Create Post</x-primary-button>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
