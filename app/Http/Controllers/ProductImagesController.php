<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductImage;

class ProductImagesController extends Controller
{
    public function create(Request $request)
    {
        $image = ProductImage::create($request->all());
        return response()->json(['image' => $image]);
    }
}
