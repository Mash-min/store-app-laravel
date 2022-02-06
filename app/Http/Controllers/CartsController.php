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
            $cart = $request->user()->carts()->create($request->all());
            return response()->json(['cart' => $cart]);
        } else {
            return response()->json(['message' => 'Product already in cart'], 422);
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

    public function find($slug)
    {
        // $cart = Cart::with('variants.item')->findOrFail($id);
        $cart = Cart::where(['slug' => $slug])
                    ->with('variants.item')
                    ->with('product.images')
                    ->first();
        return response()->json(['cart' => $cart]);
    }

    public function carts(Request $request)
    {
        $carts = $request->user()->carts()
                                 ->orderBy('created_at', 'DESC')
                                 ->where('status', 'on-cart')
                                 ->with('product.images')
                                 ->with('variants.item')
                                 ->paginate(8);
        return response()->json(['carts' => $carts]);
    }

    public function delete($id)
    {
        Cart::findOrFail($id)->delete();
        return response()->json(['message' => 'Product removed to cart']);
    }

    public function findCarts(Request $request) 
    {
        $cartArr = collect([]);
        foreach($request->slugs as $slug)
        {
            $cart = Cart::where('slug', $slug)->with('product.images')
                                              ->with('variants.item')                                  
                                              ->first();
            $cartArr->push($cart);
        }
        return $cartArr;
    }
}
