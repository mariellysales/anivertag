<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() : JsonResponse
    {
        $users = User::orderby('id', 'DESC')->paginate(1);

        return response()->json([
            'status'=> true,
            'user' => $users,
        ], 200);
    }

    public function show(User $user) : JsonResponse
    {
        return response()->json([
            'status'=> true,
            'user' => $user,
        ]);
    }
}
