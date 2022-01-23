<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartVariant;

class CartVariantsController extends Controller
{
    public function create(Request $request)
    {
        foreach($request->variant_item_id as $variant)
        {
            CartVariant::create($request->all() + [
                'variant_item_is' => $variant
            ]);
        }
    }
}
