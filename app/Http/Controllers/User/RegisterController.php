<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'contact' => 'required|numeric',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed'
        ]);
        $user = User::create($request->except('password') + [
            'password' => Hash::make($request->password)
        ]);
        $token = $user->createToken('user_token')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }
}
