<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedProduct;

class SavedProductsController extends Controller
{
    public function create(Request $request)
    {
        if(!$request->user()->productAlreadySaved($request->product_id)) {      
            $savedProduct = SavedProduct::create($request->all());
            return response()->json(['saved-product' => $savedProduct]);
        } else {
            return response()->json(['message' => "Product already saved"]);
        }
    }

    public function delete($id)
    {
        SavedProduct::findOrFail($id)->delete();
        return response()->json(['message' => 'Product removed']);
    }
}
