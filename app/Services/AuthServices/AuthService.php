<?php

namespace App\Services\AuthServices;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class AuthService
{
    public function createTokenForUser($user): array
    {
        self::checkAuthUser($user);

        $this->destroyToken();

        $token = Auth::user()->createToken('accesToken')->plainTextToken;

        $refreshToken = Auth::user()->createToken('refreshToken')->plainTextToken;

        return [$token, $refreshToken];
    }

    public function checkAuthUser(array $user)
    {
        if (!Auth::attempt($user)) {

            return response()->json(['message' => 'Failed authentication'], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function createUser($registeredData): User
    {
        return User::create($registeredData);
    }

    private function destroyToken()
    {
        return auth()->user()->tokens()->delete();
    }
}