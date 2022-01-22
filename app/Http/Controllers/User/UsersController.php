<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
