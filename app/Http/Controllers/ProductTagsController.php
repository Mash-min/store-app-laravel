<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductTag;
use App\Models\Product;

class ProductTagsController extends Controller
{
    public function create(Request $request)
    {
        foreach($request->tags as $tag)
        {
            $tag = ProductTag::create($request->all() + [
                'tag' => $tag
            ]);
        }
        return response()->json(['message' => 'Product tags added']);
    }

    public function update(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product->tags()->delete();
        foreach($request->tags as $tag)
        {
            $tag = ProductTag::create($request->all() + [
                'tag' => $tag
            ]);
        }
        return response()->json(['message' => 'Product tags updated']);
    }
}
