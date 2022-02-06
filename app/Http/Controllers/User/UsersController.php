<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;

class UsersController extends Controller
{
    public function user(Request $request)
    {
        $user = $request->user();
        if($user) {
            return response()->json([
                'user' => $user,
                'authenticated' => true
            ]);
        } else {
            return response()->json([
                'user' => null,
                'authenticated' => false
            ]);
        }
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $user->update($request->all());
        return response()->json(['user' => $user]);
    }

    public function resetPassword(Request $request)
    {
        $user = $request->user();
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        if(Hash::check($request->current_password, $user->password)) {
            $user->update(['password' => Hash::make($request->password)]);
            return response()->json(['message' => 'Password updated']);   
        } else {
            return response()->json(['message' => 'Invalid user password']);
        }
        
    }

    public function dashboard()
    {
        $products = Product::count();
        $orders = Order::count();
        $users = User::count();
        return response()->json([
            'products' => $products,
            'orders' => $orders,
            'users' => $users,
        ]);
    }
}
