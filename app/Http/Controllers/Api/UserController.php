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
        $user = User::orderby('id', 'DESC')->paginate(1);

        return response()->json([
            'status'=> true,
            'address' => $user,
        ], 200);
    }
}
