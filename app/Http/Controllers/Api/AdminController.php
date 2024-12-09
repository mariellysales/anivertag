<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() : JsonResponse
    {
        $admins = Admin::orderby('id', 'DESC')->paginate(1);

        return response()->json([
            'status'=> true,
            'admin' => $admins,
        ], 200);
    }

    public function show(Admin $admin) : JsonResponse
    {
        return response()->json([
            'status'=> true,
            'admin' => $admin,
        ]);
    }
}
