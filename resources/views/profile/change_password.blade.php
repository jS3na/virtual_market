<x-main_layout pageTitle="Change Password">

    <div class="flex flex-col md:flex-row items-center justify-between px-4 py-6">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 w-full">
            <h1 class="text-2xl md:text-4xl font-semibold text-gray-800">Dashboard / Profile / Change Password</h1>
        </div>

        <div class="flex gap-4">
            <a class="ml-2 px-4 py-2 bg-red-900 text-white rounded-md hover:bg-red-500" href="{{ route('profile') }}">Back</a>
        </div>
    </div>

    <div class="py-8">

        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
            <form action="{{ route('profile.change_password.post')}} " method="post">
                @csrf
                @method('PUT')

                <div class="grid mb-6 gap-6">
                    <div>
                        <label for="actual_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Actual password *
                        </label>
                        <input type="password" id="actual_password" name="actual_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="*********" required />
                        @error('actual_password')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            New password *
                        </label>
                        <input type="password" id="new_password" name="new_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="*********" required />
                        @error('new_password')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="new_password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            New password confirmation *
                        </label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="*********" required />
                        @error('new_password_confirmation')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @if (session('invalid_form'))
                <div class="alert alert-danger text-center mt-4 text-red-500">
                    {{ session('invalid_form') }}
                </div>
                @endif

                <button type="submit" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-6 py-3 transition-all duration-200 focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                    Update
                </button>
            </form>
        </div>
    </div>

</x-main_layout>