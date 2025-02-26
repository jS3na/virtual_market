<x-main_layout pageTitle="new Product">

    <div class="flex flex-col md:flex-row items-center justify-between px-4 py-6">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 w-full">
            <h1 class="text-2xl md:text-4xl font-semibold text-gray-800">Dashboard / Products / New</h1>
        </div>

            <div class="flex gap-4">
                @can('has_permissions', 'products.create')
                <a class="ml-2 px-4 py-2 bg-red-900 text-white rounded-md hover:bg-red-500" href="{{ route('products') }}">Back</a>
                @endcan
            </div>
    </div>

    <div class="max-w-4xl mx-auto py-8">

        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
            <form action="{{ route('products.add.post') }}" method="post">
                @csrf

                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Product Name *
                        </label>
                        <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Sugar" required />
                        @error('name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Price *
                        </label>
                        <input type="number" id="price" name="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="$$$$" required />
                        @error('price')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Stock *
                        </label>
                        <input type="number" id="stock" name="stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="100" required />
                        @error('stock')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Category *
                        </label>
                        <select id="category_id" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <option value="">No Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        Description
                    </label>
                    <textarea id="description" name="description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Product description..."></textarea>
                    @error('description')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-6 py-3 transition-all duration-200 focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                    Submit
                </button>
            </form>
        </div>
    </div>

</x-main_layout>