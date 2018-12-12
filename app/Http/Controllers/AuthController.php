<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Hash;
use App\User;

class AuthController extends Controller
{
   public function auth(Request $request)
    {
        $credenciales = $request->only('username','password');
        $token=null;
        
        try{
            if(!$token=JWTAuth::attempt($credenciales))
            {
                return response()->json(['mensaje' => 'Contraseña o Usuario Invalidos'],401);
            }
        }catch(JWTException $ex){
            return response()->json(['error' => 'Algo esta mal'],500);
        }
        
      $userObj = JWTAuth::toUser($token);
        
    $user = User::where('username', '=', $userObj->username)->get();
    return response()->json(compact('token', 'user'));
        
    }
}
