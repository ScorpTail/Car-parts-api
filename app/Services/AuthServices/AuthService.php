<?php

namespace App\Services\AuthServices;

use App\Models\User;
use App\Enum\TokenAbility;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\RegisterRequest;


class AuthService
{

    public function register($registeredData)
    {
        $user = $this->createUser($registeredData);

        [$token, $refreshToken] = $this->createTokenForUser($user);

        return [$token, $refreshToken];
    }

    public function createUser($registeredData): User
    {
        return User::create($registeredData);
    }

    public function createTokenForUser($user): array
    {
        $this->destroyToken($user);

        $token = $user->createToken('accessToken', [TokenAbility::ACCESS_TOKEN->value])->plainTextToken;

        $refreshToken = $user->createToken('refreshToken', [TokenAbility::REFRESH_TOKEN->value])->plainTextToken;

        return [$token, $refreshToken];
    }

    public function checkAuthUser(array $user)
    {
        return Auth::attempt($user);
    }

    private function destroyToken($user)
    {
        return $user->tokens()->delete();
    }
}
