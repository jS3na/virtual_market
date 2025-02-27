<x-main_layout pageTitle="Dashboard">

    <div class="flex flex-col md:flex-row items-center justify-between px-4 py-6">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 w-full">
            <h1 class="text-2xl md:text-4xl font-semibold text-gray-800">Dashboard</h1>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        <a href="{{ route('products') }}" class="group block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-xl transition-all duration-300 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Products</h5>
                    <div class="h-1 w-16 bg-blue-500 rounded mt-1 mb-3 transform origin-left group-hover:scale-x-125 transition-transform"></div>
                </div>
                <div class="p-3 bg-blue-50 rounded-full dark:bg-gray-700 group-hover:bg-blue-100 dark:group-hover:bg-gray-600 transition-colors">
                    <i class="fas fa-shopping-cart text-2xl text-blue-500 dark:text-blue-400"></i>
                </div>
            </div>
            <div class="mt-4 flex items-baseline">
                <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ count($products) }}</p>
                <span class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400">total items</span>
            </div>
            <p class="mt-3 text-sm text-gray-600 dark:text-gray-300 group-hover:text-gray-800 dark:group-hover:text-gray-200 transition-colors">Click to view all products in inventory</p>
        </a>

        <a href="{{ route('categories') }}" class="group block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-xl transition-all duration-300 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Categories</h5>
                    <div class="h-1 w-16 bg-blue-500 rounded mt-1 mb-3 transform origin-left group-hover:scale-x-125 transition-transform"></div>
                </div>
                <div class="p-3 bg-blue-50 rounded-full dark:bg-gray-700 group-hover:bg-blue-100 dark:group-hover:bg-gray-600 transition-colors">
                    <i class="fas fa-tag text-2xl text-blue-500 dark:text-blue-400"></i>
                </div>
            </div>
            <div class="mt-4 flex items-baseline">
                <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ count($categories) }}</p>
                <span class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400">total items</span>
            </div>
            <p class="mt-3 text-sm text-gray-600 dark:text-gray-300 group-hover:text-gray-800 dark:group-hover:text-gray-200 transition-colors">Click to view all categories in inventory</p>
        </a>

        <a href="{{ route('users') }}" class="group block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-xl transition-all duration-300 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Users</h5>
                    <div class="h-1 w-16 bg-blue-500 rounded mt-1 mb-3 transform origin-left group-hover:scale-x-125 transition-transform"></div>
                </div>
                <div class="p-3 bg-blue-50 rounded-full dark:bg-gray-700 group-hover:bg-blue-100 dark:group-hover:bg-gray-600 transition-colors">
                    <i class="fas fa-users text-2xl text-blue-500 dark:text-blue-400"></i>
                </div>
            </div>
            <div class="mt-4 flex items-baseline">
                <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ count($users) }}</p>
                <span class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400">total items</span>
            </div>
            <p class="mt-3 text-sm text-gray-600 dark:text-gray-300 group-hover:text-gray-800 dark:group-hover:text-gray-200 transition-colors">Click to view all users</p>
        </a>
    </div>

    <div class="mt-8 p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Top 10 Categories with most products</h2>
        <canvas id="categoriesChart"></canvas>
    </div>

    <div class="mt-8 p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Products with less stock</h2>
        <ul class="mt-4 space-y-2">
            @foreach ($low_stock_products as $product)
                <li class="flex justify-between">
                    <span class="text-gray-800 dark:text-white">{{ $product->name }}</span>
                    <span class="text-red-500">{{ $product->stock }} units</span>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="mt-8 p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Top 10 Products with more stock</h2>
        <ul class="mt-4 space-y-2">
            @foreach ($high_stock_products as $product)
                <li class="flex justify-between">
                    <span class="text-gray-800 dark:text-white">{{ $product->name }}</span>
                    <span class="text-green-500">{{ $product->stock }} units</span>
                </li>
            @endforeach
        </ul>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('categoriesChart').getContext('2d');

            const categories = @json($top_categories->pluck('name'));
            const totals = @json($top_categories->pluck('total'));

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: categories,
                    datasets: [{
                        label: 'Products Count',
                        data: totals,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

</x-main_layout>
