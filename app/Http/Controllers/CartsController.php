<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartVariant;

class CartsController extends Controller
{
    public function create(Request $request)
    {
        if(!$request->user()->productAlreadyInCart($request->product_id)) {
            $cart = Cart::create($request->all());
            return response()->json(['cart' => $cart]);
        } else {
            return response()->json(['message' => 'Product already in cart']);
        }
    }

    public function variants(Request $request)
    {
        foreach($request->variants as $variant)
        {
            CartVariant::create([
                'cart_id' => $request->cart_id,
                'variant_item_id' => $variant
            ]);
        }
    }

    public function find($id)
    {
        $cart = Cart::with('variants.variantItem')->findOrFail($id);
        return response()->json(['cart' => $cart]);
    }

    public function carts(Request $request)
    {
        $carts = $request->user()->carts()
                                 ->orderBy('created_at', 'DESC')
                                 ->with('variants.variantItem')
                                 ->paginate(8);
        return response()->json(['carts' => $carts]);
    }

    public function delete($id)
    {
        Cart::findOrFail($id)->delete();
        return response()->json(['message' => 'Product removed to cart']);
    }
}
