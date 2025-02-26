<x-main_layout pageTitle="Categories">

    <div class="flex flex-col md:flex-row items-center justify-between px-4 py-6">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 w-full">
            <h1 class="text-2xl md:text-4xl font-semibold text-gray-800">Dashboard / Categories</h1>
        </div>

        <form action="{{ route('categories.search') }}" method="get" class="flex items-center gap-4 w-full max-w-4xl">
            <div class="flex w-full gap-2">
                <div class="relative w-full">
                    <input name="search" type="search" id="search-dropdown" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-r-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search" />
                    <button type="submit" class="absolute top-0 right-0 p-2.5 h-full text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </button>
                </div>

                @can('has_permissions', 'categories.create')
                <a class="ml-2 px-4 py-2 bg-blue-900 text-white rounded-md hover:bg-blue-500" href="{{ route('categories.add') }}">New</a>
                @endcan
            </div>
        </form>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

            @if (count($categories) == 0)
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                    Nothing found
                </th>
            </tr>

            @else

            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Category name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Creation date
                    </th>
                    @if(Gate::allows('has_permissions', 'categories.update') || Gate::allows('has_permissions', 'categories.delete'))
                    <th scope="col" class="px-6 py-3">Action</th>
                    @endif
                </tr>
            </thead>

            <tbody>

                @foreach ($categories as $category)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $category->name }}
                    </th>
                    <td class="px-6 py-4">
                        @if ($category->created_at)
                        {{ date('d-m-Y | H:i:s', strtotime($category->created_at)) }}
                        @else
                        None
                        @endif
                    </td>
                    <td class="px-6 py-4 flex flex-row gap-4">
                        @can('has_permissions', 'categories.update')
                        <a href="{{ route('categories.edit', ['category_id' => $category->id]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        @endcan
                        @can('has_permissions', 'categories.delete')
                        <form action="{{ route('categories.delete', ['category_id' => $category->id]) }}" method="POST" onsubmit="return confirm('Are you sure that you want to delete?');">
                            @csrf
                            @method('DELETE')
                            <button class="cursor-pointer font-medium text-red-600 dark:text-red-500 hover:underline" type="submit">Delete</button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
            @endif

        </table>
    </div>


    <div class="flex justify-center items-center p-5">
        {{ $categories->links('pagination::tailwind') }}
    </div>


</x-main_layout>