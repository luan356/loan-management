<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{

    
    //  login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'nao foi possivel criar o token'], 500);
        }

        return response()->json(compact('token'));
    }

    // func de logout
    public function logout()
    {
        auth()->logout();
    return response()->json(['message' => 'deslogado realizado com sucesso!']);
    }

    //funk  refresh do token
    public function refresh()
    {
        try {
            $token = JWTAuth::refresh(JWTAuth::getToken());
            return response()->json(compact('token'));
        } catch (JWTException $e) {
            return response()->json(['error' => 'nao foi possivel atualizar o token'], 500);
        }
    }
}
