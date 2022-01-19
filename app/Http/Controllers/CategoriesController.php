<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function create(Request $request)
    {
        $category = Category::create($request->all());
        return response()->json(['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json(['category' => $category]);
    }

    public function find($id)
    {
        $category = Category::findOrFail($id);
        return response()->json(['category' => $category]);
    }

    public function categories($limit)
    {
        $categories = Category::orderBy('created_at', 'DESC')->paginate($limit);
        return response()->json(['categories' => $categories]);
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
        return response()->json(['message' => 'Category deleted']);
    }
}
