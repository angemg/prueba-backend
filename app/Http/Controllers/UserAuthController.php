<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Notifications\RoleNotification;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {

        $registerUser = $request->validate([
            'name'      =>'required|string',
            'email'     =>'required|string|email|unique:users',
            'password'  =>'required|min:6',
        ]);

        // Creo nuevos usuarios
        User::create([
            'name'       => $registerUser['name'],
            'email'      => $registerUser['email'],
            'password'   => Hash::make($registerUser['password']),
            'role'       => 'UserJunior', //Asigno el Rol por defecto a los nuevos usuarios
        ]);

        return response()->json([
            'message' => 'User Created Successfully',
        ]);
    }

    public function login(Request $request)
    {

        $loginUser = $request->validate([
            'email'     =>'required|string|email',
            'password'  =>'required|min:6'
        ]);

        $user = User::where('email', $loginUser['email'])->first();

        if(!$user || !Hash::check($loginUser['password'], $user->password))
        {
            return response()->json(['message' => 'Invalid Credentials'],401);
        }

        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;

        if (isset($token) && $user->role == 'UserJunior')
        {
            $messages["solicitud"] = "Estoy solicitando cambio de Rol";
            $messages["solicitante"] = $user->name;
            $user->notify(new RoleNotification($messages));
        }
        return response()->json(['access_token' => $token,
                                'message' => "Login Successfully"]);

    }

    public function logout(){

        auth()->user()->tokens()->delete();
    
        return response()->json(["message" => "Logged Out Successfully"]);
    }
}
