<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(UserRequest $request)
    {
        DB::beginTransaction();

        try{
            $user = User::create([
                "name" => $request->name,
                "cpf" => $request->cpf,
                "email" => $request->email,
                "birth_date" => $request->birth_date,
                "neighborhood" => $request->neighborhood,
                "main_phone" => $request->main_phone,
                "reference_contact_name" => $request->reference_contact_name,
                "reference_contact" => $request->reference_contact,
                "is_active" => $request->is_active
            ]);
            DB::commit();
            
            return response()->json([
                'status'=> true,
                'address' => $user,
                'message' => 'Usuário cadastrado com sucesso!'
            ], 201);
        }catch(Exception $e){
            DB::rollBack();

            return response()->json([
                'status'=> true,
                'message' => 'Operação não concluída: usuário não cadastrado!',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function update(UserRequest $request, User $user)
    {
        try{
            try{
                $user->update([
                    "name" => $request->name,
                    "cpf" => $request->cpf,
                    "email" => $request->email,
                    "birth_date" => $request->birth_date,
                    "neighborhood" => $request->neighborhood,
                    "main_phone" => $request->main_phone,
                    "reference_contact_name" => $request->reference_contact_name,
                    "reference_contact" => $request->reference_contact,
                    "is_active" => $request->is_active
                ]);
                DB::commit();
                
                return response()->json([
                    'status'=> true,
                    'address' => $user,
                    'message' => 'Usuário editado com sucesso!'
                ], 201);
            }catch(Exception $e){
                DB::rollBack();
    
                return response()->json([
                    'status'=> true,
                    'message' => 'Operação não concluída: usuário não editado!',
                    'error' => $e->getMessage()
                ], 400);
            }

        }catch(Exception $e){
            DB::rollBack();

            return response()->json([
                'status'=> true,
                'message' => 'Operação não concluída: usuário não editado!',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function destroy(User $user)
    {
        try{
            $user->delete();
            
            return response()->json([
                'status'=> true,
                'address' => $user,
                'message' => 'Usuário apagado com sucesso!'
            ], 201);
        }catch(Exception $e){
            DB::rollBack();

            return response()->json([
                'status'=> true,
                'message' => 'Operação não concluída: usuário não apagado!'
            ], 400);
        }
    }
}
