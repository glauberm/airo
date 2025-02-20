<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationController implements HasMiddleware
{
    public static function middleware(): array
    {
        return [new Middleware('auth:api', except: ['login'])];
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if ($token = JWTAuth::attempt($request->validated())) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    public function logout(): JsonResponse
    {
        Auth::logout();

        return response()->json(['message' => 'Logged out.']);
    }

    public function authenticatedUser(): User
    {
        return new User(Auth::user());
    }

    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(Auth::refresh());
    }

    private function respondWithToken(string $token): JsonResponse
    {
        return response()->json(['token' => $token]);
    }
}
