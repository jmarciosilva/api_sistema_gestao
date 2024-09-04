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
    public function index(): JsonResponse
    {
        $users = User::orderBy('id', 'DESC')->get();

        return response()->json([
            'status' => true,
            'bills' => $users,
        ], 200);

    }

    public function show(User $user): JsonResponse
    {
        return response()->json([
            'status' => true,
            'user' => $user,
        ], 200);
    }

    public function store(UserRequest $request): JsonResponse
    {
        // Iniciando a Transação
        DB::beginTransaction();

        try{
            // Cadastrando no banco de dados
            $user = User::create([
                "name" => $request->name,
			    "email" => $request->email,
                "password" => $request->password
            ]);

            // Operação com Sucesso
            DB::commit();

            // Retornando os dados em formato json com status 201
            return response()->json([
                'status' => true,
                'bill' => $user,
                'message' => 'Usuário cadastrado com sucesso.'
            ], 201);

        } catch(Exception $e){
            // Operação não foi concluída com êxito
            DB::rollBack();

            // Retornando os dados em formato jso com status 400
            return response()->json([
                'status' => true,
                'message' => 'Usuário não cadastrado!'
            ], 400);
        }
    }

    public function update(UserRequest $request, User $user): JsonResponse
    {
        // Iniciar a Transação
        DB::beginTransaction();


        try{
            // editar o registro no banco de dados
            $user->update([
                'name' => $request->name,
                "email"=>  $request->email,
		        "password" => $request->password
            ]);

             // Operação com Sucesso
             DB::commit();

             // Retornando os dados em formato json com status 201
             return response()->json([
                 'status' => true,
                 'bill' => $user,
                 'message' => 'Usuário editado com sucesso.'
             ], 201);

        }catch(Exception $e){
          // Operação não foi concluída com êxito
          DB::rollBack();

          // Retornando os dados em formato jso com status 400
          return response()->json([
              'status' => true,
              'message' => 'Usuário não editado!'
          ], 400);  
        }

    }
}

