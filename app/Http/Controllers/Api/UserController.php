<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Address;
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

    public function indexFullUser() : JsonResponse
    {
        $users = User::with('address')
        ->orderBy('id', 'DESC')
        ->paginate(1);

        return response()->json([
        'status' => true,
        'data' => $users,
        ], 200);
    }


    public function show(User $user) : JsonResponse
    {
        return response()->json([
            'status'=> true,
            'user' => $user,
        ]);
    }

    public function showFullUser(User $user) : JsonResponse
    {
        $userWithAddress = $user->load('address');
        return response()->json([
            'status'=> true,
            'user' => $userWithAddress,
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
                'user' => $user,
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

    public function createFullUser(UserRequest $request)
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

            DB::beginTransaction();

            $address = Address::create([
                "postal_code" => $request->postal_code,
                "street" => $request->street,
                "number" => $request->number,
                "additional_information" => $request->additional_information,
                "neighborhood" => $request->neighborhood,
                "city" => $request->city,
                "state" => $request->state,
                "country" => $request->country,
                "user_id" => $user->id
            ]);
            DB::commit();
            
            return response()->json([
                'status'=> true,
                'data' => [ 
                    'user' => $user,
                    'address' => $address,
                ],
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

    public function updateFullUser(UserRequest $request, User $user)
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
                
                DB::beginTransaction();

                $address = Address::create([
                    "postal_code" => $request->postal_code,
                    "street" => $request->street,
                    "number" => $request->number,
                    "additional_information" => $request->additional_information,
                    "neighborhood" => $request->neighborhood,
                    "city" => $request->city,
                    "state" => $request->state,
                    "country" => $request->country,
                    "user_id" => $user->id
                ]);
                DB::commit();
                
                return response()->json([
                    'status'=> true,
                    'data' => [ 
                        'user' => $user,
                        'address' => $address,
                    ],
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

    public function destroyFullUser(User $user)
    {
        try{
            $user->address()->delete();

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

    public function filter(Request $request): JsonResponse
    {
        $filters = $request->only(['name', 'cpf', 'neighborhood', 'date', 'start_date', 'end_date']);

        $query = User::query();

        $query->with('address');



        if (!empty($filters['name'])) {
            $query->where('name', 'LIKE', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['cpf'])) {
            $query->where('cpf', $filters['cpf']);
        }

        if (!empty($filters['neighborhood'])) {
            $query->whereHas('address', function ($addressQuery) use ($filters) {
                $addressQuery->where('neighborhood', 'LIKE', '%' . $filters['neighborhood'] . '%');
            });
        }   

        if (!empty($filters['date'])) {
            $query->whereDate('birth_date', $filters['date']);
        }

        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $query->whereBetween('birth_date', [$filters['start_date'], $filters['end_date']]);
        }

        $users = $query->orderBy('id', 'DESC')->paginate(10);

        return response()->json([
            'status' => true,
            'users' => $users,
        ]);
    }
}
