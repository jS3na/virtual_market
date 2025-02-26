<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function page()
    {
        $categories = Category::paginate(15);

        return view('categories.categories', [
            'categories' => $categories
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $query = Category::query();

        if ($search) {
            $query->where('name', 'like', "%$search%");
        }

        $categories = $query->paginate(15);

        return view('categories.categories', [
            'categories' => $categories,
        ]);
    }

    public function addPage()
    {
        return view('categories.add');
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
        ], [
            'name.required' => 'The category name is required.',
            'name.min' => 'The category name must have at least :min characters.',
            'name.max' => 'The category name must have at most :max characters.'
        ]);

        $name = $request->input('name');

        $category = new Category();
        $category->name = $name;
        $category->save();

        return redirect(route('categories'));
    }

    public function editPage($category_id)
    {

        $category = Category::where('id', $category_id)->first();

        if(!$category) return redirect()->back();
        
        return view('categories.edit', [
            'category' => $category,
        ]);

    }

    public function editCategory(Request $request, $category_id)
    {

        $category = Category::where('id', $category_id)->first();

        if(!$category) return redirect()->back();

        $request->validate([
            'name' => 'required|min:3|max:100',
        ], [
            'name.required' => 'The category name is required.',
            'name.min' => 'The category name must have at least :min characters.',
            'name.max' => 'The category name must have at most :max characters.',
        ]);

        $name = $request->input('name');

        $category->name = $name;
        $category->save();

        return redirect(route('categories'));
    }

    public function deleteCategory($category_id){
        $category = Category::where('id', $category_id)->first();
        if(!$category) return redirect()->back();

        $category->delete();
        return redirect(route('categories'));
    }
}
