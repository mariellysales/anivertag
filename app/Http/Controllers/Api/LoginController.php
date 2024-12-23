<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::guard('admins')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $admin = Auth::guard('admins')->user();

            $token = $request->user()->createToken('api-token')->plainTextToken;

            return response()->json([
                'status' => true,
                'token' => $token,
                'admin' => $admin,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Login e/ou senha incorretos!',
            ], 404);
        }
    }
}

