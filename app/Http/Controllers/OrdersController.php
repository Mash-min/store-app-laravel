<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function create(Request $request)
    {
        foreach($request->carts as $slug) 
        {
            $cart = Cart::where('slug', $slug)->firstOrFail();
            $total = $cart->product->price * $cart->quantity + $cart->product->shipping_fee;
            Order::create([
                'total' => $total,
                'cart_id' => $cart->id,
                'user_id' => $cart->user->id,
                'contact' => $request->contact
            ]);
            $cart->update(['status' => 'on-process']);
        }
        return response()->json(['message' => "Orders are being processed"]);
    }

    public function orders(Request $request, $status)
    {   
        $orders = $request->user()->orders()
                                  ->where('status', $status)
                                  ->with('cart.product.variants.items')
                                  ->with('cart.product.images')
                                  ->with('cart.variants.item')
                                  ->with('cart.user')
                                  ->orderBy('created_at', 'DESC')->paginate(15);
        return response()->json(['orders' => $orders]);
    }

    public function delete($id)
    {
        Order::findOrFail($id)->delete();
        return response()->json(['message' => 'Order deleted']);
    }

    public function update(Request $request, $id) 
    {
        $order = Order::findOrFail($id)->update($request->all());
        return response()->json(['order' => $order]);
    }

    public function allOrders($status)
    {
        if($status == "all") {
            $orders = Order::with('cart.product.variants.items')
                           ->with('cart.variants.item')
                           ->with('cart.user')
                           ->orderBy('created_at', 'DESC')->paginate(15);
            return response()->json(['orders' => $orders]);
        } else {
            $orders = Order::where('status', $status)
                           ->with('cart.product.variants.items')
                           ->with('cart.variants.item')
                           ->with('cart.user')
                           ->orderBy('created_at', 'DESC')->paginate(15);
            return response()->json(['orders' => $orders]);
        }
    }

    public function search($data)
    {
        $orders = Order::where(['slug' => $data])
                       ->orWhere(['total' => $data])
                       ->with('cart.product.variants.items')
                       ->with('cart.variants.item')
                       ->with('cart.user')
                       ->paginate(10);
        return response()->json(['orders' => $orders]);
    }
}