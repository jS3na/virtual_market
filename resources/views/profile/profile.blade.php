<x-main_layout pageTitle="Profile">

    <div class="flex flex-col items-center justify-between px-4 py-6">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 w-full">
            <h1 class="text-2xl md:text-4xl font-semibold text-gray-800">Dashboard / Profile</h1>
        </div>

        <div>
        <a class="ml-2 px-4 py-2 bg-blue-900 text-white rounded-md hover:bg-blue-500" href="{{ route('profile.change_password') }}">Change Password</a>
        </div>

    </div>


</x-main_layout>