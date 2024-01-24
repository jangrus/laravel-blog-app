<x-app-layout>
    @inject('profileController', App\Http\Controllers\ProfileController::class)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <ul class="divide-y">
                        <form action="{{ route('edit-user-role') }}" method="POST">
                        {{  csrf_field() }}
                        {{ method_field('PATCH') }}
                        @foreach($users as $user)
                            <li class="py-6 px-2 ">
                                <a class="text-xl font-semibold block text-gray-500">
                                    Id: {{ $user->id }}
                                    <br>
                                    Name: {{ $user->name }} {{ $user->surname }}
                                </a>
                                <select name="role_id_{{ $user->id }}" id="role_id_{{ $user->id }}" class="form-control bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" required >
                                    @foreach ($roles as $category)
                                        <option value="{{ $category->id }}" {{ $profileController->getUserRole($user) === $category->id ? 'selected' : '' }}>{{ $category->role_name }}</option>
                                    @endforeach
                                </select>
                                <x-primary-button type="submit" class="btn btn-primary">Change Role</x-primary-button>
                            </li>
                        @endforeach
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
