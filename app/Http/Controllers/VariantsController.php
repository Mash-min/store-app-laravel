<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variant;

class VariantsController extends Controller
{
    public function create(Request $request)
    {
        $variant = Variant::create($request->all());
        return response()->json(['variant' => $variant]);
    }
}
