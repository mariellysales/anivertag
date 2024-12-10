<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function index() : JsonResponse
    {
        $addresses = Address::orderby('id', 'DESC')->paginate(1);

        return response()->json([
            'status'=> true,
            'address' => $addresses,
        ], 200);
    }

    public function show(Address $address) : JsonResponse
    {
        return response()->json([
            'status'=> true,
            'address' => $address,
        ]); 
    }

    public function store(AddressRequest $request)
    {
        DB::beginTransaction();

        try{
            $address = Address::create([
                "postal_code" => $request->postal_code,
                "street" => $request->street,
                "number" => $request->number,
                "additional_information" => $request->additional_information,
                "neighborhood" => $request->neighborhood,
                "city" => $request->city,
                "state" => $request->state,
                "country" => $request->country,
                "user_id" => $request->user_id
            ]);
            DB::commit();
            
            return response()->json([
                'status'=> true,
                'address' => $address,
                'message' => 'Endereço cadastrado com sucesso!'
            ], 201);
        }catch(Exception $e){
            DB::rollBack();

            return response()->json([
                'status'=> true,
                'message' => 'Operação não concluída: endereço não cadastrado!'
            ], 400);
        }

    }
}