<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ],201);
    }

    public function login(Request $request) {
        if (!Auth::attempt($request->only('email','password'))) {
            return response()->json([
                'message' => 'Invalide credentials'
            ],401);
        }

        $token = $request->user()->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $request->user(),
            'token' => $token
        ]);
    }
}
