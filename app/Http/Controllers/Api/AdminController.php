<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(AdminRequest $request)
    {
        DB::beginTransaction();

        try{
            $admin = Admin::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => $request->password,
                "is_active" => $request->is_active,
                "is_admin" => $request->is_admin,
            ]);
            DB::commit();
            
            return response()->json([
                'status'=> true,
                'address' => $admin,
                'message' => 'Administrador cadastrado com sucesso!'
            ], 201);
        }catch(Exception $e){
            DB::rollBack();

            return response()->json([
                'status'=> true,
                'message' => 'Operação não concluída: administrador não cadastrado!'
            ], 400);
        }

    }

    public function update(AdminRequest $request, Admin $admin)
    {
        DB::beginTransaction();

        try{
        $admin->update([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password,
            "is_active" => $request->is_active,
            "is_admin" => $request->is_admin,
        ]);

        DB::commit();

        return response()->json([
            'status'=> true,
            'address' => $admin,
            'message' => 'Administrador editado com sucesso!'
        ], 201);


        }catch (Exception $e){
            DB::rollBack();

            return response()->json([
                'status'=> true,
                'message' => 'Operação não concluída: administrador não editado!'
            ], 400);
        }
    }

    public function destroy(Admin $admin)
    {
        try{
            
            $admin->delete();
    
            return response()->json([
                'status'=> true,
                'address' => $admin,
                'message' => 'Administrador apagado com sucesso!'
            ], 201);
    
    
            }catch (Exception $e){
                DB::rollBack();
    
                return response()->json([
                    'status'=> true,
                    'message' => 'Operação não concluída: administrador não apagado!'
                ], 400);
            }
    }
}
