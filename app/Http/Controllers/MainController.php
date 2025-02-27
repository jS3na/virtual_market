<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function dashboard(){
        $products = Product::all();
        $categories = Category::all();
        $users = User::all();
        
        $top_categories = Category::join('products', 'categories.id', '=', 'products.category_id')
        ->select('categories.name', DB::raw('COUNT(products.id) as total'))
        ->groupBy('categories.name')
        ->orderByDesc('total')
        ->limit(10)
        ->get();

        $low_stock_products = Product::where('stock', '<', 5)->get();
        $high_stock_products = Product::orderByDesc('stock')->limit(10)->get();

        return view('dashboard.dashboard', [
            'products' => $products,
            'categories' => $categories,
            'users' => $users,
            'top_categories' => $top_categories,
            'low_stock_products' => $low_stock_products,
            'high_stock_products' => $high_stock_products
        ]);

    }
}
