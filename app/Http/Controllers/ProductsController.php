<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ProductsController extends Controller
{
    public function page()
    {
        $products = Product::paginate(15);
        $categories = Category::all();

        return view('products.products', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $category_id = $request->input('category_id');

        $query = Product::query();

        if ($search) {
            $query->where('name', 'like', "%$search%");
        }

        if ($category_id) {
            $query->where('category_id', $category_id === 'none' ? null : $category_id);
        }

        $products = $query->paginate(15);
        $categories = Category::all();

        return view('products.products', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function addPage()
    {
        $categories = Category::all();
        return view('products.add', [
            'categories' => $categories
        ]);
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ], [
            'name.required' => 'The product name is required.',
            'name.min' => 'The product name must have at least :min characters.',
            'name.max' => 'The product name must have at most :max characters.',
            'price.required' => 'The product price is required.',
            'price.numeric' => 'The product price must be a numeric.',
            'stock.required' => 'The product stock is required.',
            'stock.integer' => 'The product stock must be a integer.',
        ]);

        $name = $request->input('name');
        $description = $request->input('description');
        $price = $request->input('price');
        $stock = $request->input('stock');
        $category_id = $request->input('category_id');

        $product = new Product();
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->stock = $stock;
        $product->category_id = $category_id;
        $product->save();

        return redirect(route('products'));
    }

    public function editPage($product_id)
    {
        $categories = Category::all();
        $product = Product::where('id', $product_id)->first();


        if (!$product) return redirect()->back();

        return view('products.edit', [
            'categories' => $categories,
            'product' => $product
        ]);
    }

    public function editProduct(Request $request, $product_id)
    {

        $product = Product::where('id', $product_id)->first();

        if (!$product) return redirect()->back();

        $request->validate([
            'name' => 'required|min:3|max:100',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ], [
            'name.required' => 'The product name is required.',
            'name.min' => 'The product name must have at least :min characters.',
            'name.max' => 'The product name must have at most :max characters.',
            'price.required' => 'The product price is required.',
            'price.numeric' => 'The product price must be a numeric.',
            'stock.required' => 'The product stock is required.',
            'stock.integer' => 'The product stock must be a integer.',
        ]);

        $name = $request->input('name');
        $description = $request->input('description');
        $price = $request->input('price');
        $stock = $request->input('stock');
        $category_id = $request->input('category_id');

        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->stock = $stock;
        $product->category_id = $category_id;
        $product->save();

        return redirect(route('products'));
    }

    public function deleteProduct($product_id)
    {
        $product = Product::where('id', $product_id)->first();
        if (!$product) return redirect()->back();

        $product->delete();
        return redirect(route('products'));
    }
}
