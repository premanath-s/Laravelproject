<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtAuthController extends Controller
{
public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (!$token = Auth::guard('api')->attempt($credentials)) {
        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }

    $user = Auth::guard('api')->user();

    // Generate new token with custom claim
    $customToken = JWTAuth::claims([
        'is_admin' => (bool) $user->is_admin
    ])->fromUser($user);

    return response()->json([
        'user' => $user,
        'token' => $customToken
    ]);
}
}
