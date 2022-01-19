<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;

class ProductCategoriesController extends Controller
{

    public function create(Request $request)
    {
        foreach($request->categories as $category)
        {
            $category = ProductCategory::create([
                'product_id' => $request->product_id,
                'category' => $category
            ]);
        }
        return response()->json(['message' => "Categories added"]);
    }

    public function update(Request $request)
    {
        $product = Product::findOrFail($request->product_id)->categories()->delete();
        foreach($request->categories as $category)
        {
            ProductCategory::create([
                'product_id' => $request->product_id,
                'category' => $category
            ]);
        }
        return response()->json(['message' => 'Product categories updated']);
    }

}
