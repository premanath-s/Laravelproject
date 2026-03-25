<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false,
        ]);

        $customToken = JWTAuth::claims([
            'is_admin' => (bool) $user->is_admin,
        ])->fromUser($user);

        return response()->json([
            'status' => true,
            'message' => 'Registered successfully',
            'user' => $user,
            'token' => $customToken,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::guard('api')->attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        $user = Auth::guard('api')->user();

        $customToken = JWTAuth::claims([
            'is_admin' => (bool) $user->is_admin,
        ])->fromUser($user);

        return response()->json([
            'status' => true,
            'user' => $user,
            'token' => $customToken,
        ]);
    }

    public function logout()
    {
        try {
            Auth::guard('api')->logout();

            return response()->json([
                'status' => true,
                'message' => 'Logged out successfully',
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Logout failed',
            ], 500);
        }
    }
}
