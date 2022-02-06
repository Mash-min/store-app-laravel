<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductCreateRequest;

class ProductsController extends Controller
{
    public function create(ProductCreateRequest $request)
    {
        $product = Product::create($request->all());
        return response()->json(['product' => $product]);
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(['message' => 'Product deleted']);
    }

    public function find($slug)
    {
        $product = Product::with('images')
                          ->with('categories')
                          ->with('tags')
                          ->with('variants.items')
                          ->where(['slug' => $slug])
                          ->firstOrFail();
        return response()->json(['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json(['product' => $product]);
    }

    public function products($limit)
    {
        $products = Product::with('images')
                           ->with('categories')
                           ->with('variants.items')
                           ->orderBy('created_at', 'DESC')
                           ->paginate($limit);
        return response()->json(['products' => $products]);
    }

    public function archive($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['status' => 'archived']);
        return response()->json(['product' => $product]);
    }

    public function restore($id) 
    {
        $product = Product::findOrFail($id);
        $product->update(['status' => 'active']);
        return response()->json(['product' => $product]);
    }

    public function search($product) 
    {
        $products = Product::where('name', 'like', '%'.$product.'%')
                         ->orWhere('slug', $product)
                         ->orWhere('price', $product)
                         ->with('images')
                         ->with('categories')
                         ->with('variants.items')
                         ->paginate(12);
        return response()->json(['products' => $products]);
    }
}
