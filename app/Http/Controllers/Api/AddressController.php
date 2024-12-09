<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Bill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index() : JsonResponse
    {
        $address = Address::orderby('id', 'DESC')->paginate(1);

        return response()->json([
            'status'=> true,
            'address' => $address,
        ], 200);
    }
}
