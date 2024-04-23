<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserAuthController extends Controller
{
    public function register(Request $request)
    {

        $registerUser = $request->validate([
            'name'      =>'required|string',
            'email'     =>'required|string|email|unique:users',
            'password'  =>'required|min:6',
            'role'      =>'required|string',
        ]);

        User::create([
            'name'       => $registerUser['name'],
            'email'      => $registerUser['email'],
            'password'   => Hash::make($registerUser['password']),
            'role'       => $registerUser['role'],
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

        return response()->json(['access_token' => $token]);
    }

    public function logout(){

        auth()->user()->tokens()->delete();
    
        return response()->json(["message" => "Logged Out Successfully"]);
    }
}
