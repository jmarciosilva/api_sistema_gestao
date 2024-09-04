<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            // Recuperar os dados do usuário
            $user = Auth::user();

            // Gerar o Token do Usuário
            $token = $request->user()->createToken('api-token')->plainTextToken;

            return response()->json([
                'status' => true,
                'token' => $token,
                'user' => $user,
            ], 201);
        }else {
           return response()->json([
                'status' => false,
                'message' => 'Usuário ou Senha Incorreto!'
           ], 404); 
        }

    }
}
