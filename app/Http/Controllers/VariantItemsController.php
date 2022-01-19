<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VariantItem;

class VariantItemsController extends Controller
{
    public function create(Request $request)
    {
        foreach($request->items as $item)
        {
            VariantItem::create($request->all() + [
                'name' => $item
            ]);
        }
        return response()->json(['message' => 'Variant items added']);
    }
}
