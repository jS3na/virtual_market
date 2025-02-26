<x-main_layout pageTitle="Edit Role">

    <div class="flex flex-col md:flex-row items-center justify-between px-4 py-6">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 w-full">
            <h1 class="text-2xl md:text-4xl font-semibold text-gray-800">Dashboard / Roles / Edit</h1>
        </div>

        <div class="flex gap-4">
            <a class="ml-2 px-4 py-2 bg-red-900 text-white rounded-md hover:bg-red-500" href="{{ route('roles') }}">Back</a>
        </div>
    </div>

    <div class="py-8">

        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
            <form action="{{ route('roles.edit.post', ['role_id' => $role->id]) }}" method="post">
                @csrf
                @method('PUT')

                <div class="grid mb-6 gap-6">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Role Name *
                        </label>
                        <input type="text" value="{{ $role->name }}" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Normal user" required />
                        @error('name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Description
                        </label>
                        <textarea id="description" name="description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Role description...">{{ $role->description }}</textarea>
                        @error('description')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <div class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Permissions</div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($permissions as $permission)
                                <div class="flex items-center space-x-3">
                                    <input 
                                        type="checkbox" 
                                        name="{{ $permission->id }}" 
                                        id="permission_{{ $permission->id }}"
                                        {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }} 
                                        class="w-4 h-4 bg-gray-200 border-2 border-gray-300 rounded-lg checked:bg-blue-600 checked:border-blue-600 focus:ring-2 focus:ring-blue-500 transition duration-200" />
                                    <label for="permission_{{ $permission->id }}" class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $permission->name }}</label>
                                </div>
                                @error($permission->id)
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            @endforeach
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-6 py-3 transition-all duration-200 focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                    Update
                </button>
            </form>
        </div>
    </div>

</x-main_layout>
