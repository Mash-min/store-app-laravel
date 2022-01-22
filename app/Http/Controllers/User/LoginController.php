<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        if(!auth()->attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid user credentials'], 401);
            // ================ Return error message if not authorized ===================
        } else {
            $user = auth()->user();
            $user->tokens()->delete();
            $token = $user->createToken('user_token')->plainTextToken;
            return response()->json(['user' => $user, 'token' => $token]);
            // ================ Return user and token if authorized ===================
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
