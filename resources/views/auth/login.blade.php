<x-main_layout pageTitle="Login">

    <div class="flex items-center justify-center h-screen w-full">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 w-full max-w-sm mx-auto">
            <h2 class="text-2xl font-semibold text-center text-gray-800 dark:text-gray-300 mb-6">Login</h2>

            <form action="{{ route('login.post') }}" method="post">

            @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">E-mail</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" class="w-full px-4 py-2 text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:placeholder-gray-400" required />
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" class="w-full px-4 py-2 text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:placeholder-gray-400" required />
                </div>

                <button type="submit" class="w-full py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition duration-200">Login</button>
            </form>
        </div>
    </div>

</x-main_layout>