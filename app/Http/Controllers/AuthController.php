<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\hash;
use App\Models\User;

class AuthController extends Controller
{
    function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|string|max:255',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'usuario' => $request->usuario,
            'password' => hash::make($request->password)
        ]);

        $user->createToken('auth_token')->plainTextToken;

        return response()->json(['success' => true], 200);

    }

    // function login(Request $request) 
    // {
    //     if (!Auth::attempt($request->only('usuario','password'))) {
    //         return response()->json(['success' => false,401]);
    //     }
    //     $user = User::where('usuario', $request['usuario'])->firstOrFail();
    //     $token = $user->createToken('auth_token')->plainTextToken;
        
    //     return response()->json([
    //         'tokenType' => $token
    //     ]);


    // }
    function login(Request $request) 
    {
        $user = User::where('usuario', $request['usuario'])->firstOrFail();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciales no válidas'], 401);
        }
    
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json([
            'tokenType' => $token
        ]);
    }

    function logout() { 
        auth()->user()->tokens()->delete();
        return ['message' => 'eliminamos y nos salimos'];
    }

    
    
}
