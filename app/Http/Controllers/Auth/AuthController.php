<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use Laravel\Sanctum\PersonalAccessToken;
use App\Services\AuthServices\AuthService;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{

    public function __construct(private AuthService $authService)
    {
    }

    public function register(RegisterRequest $request)
    {
        $registeredData = $request->validated();

        [$token, $refreshToken] = $this->authService->register($registeredData);

        return response()->json(
            [
                'message' => 'Success registration',
                'token' => $token,
                'refreshToken' => $refreshToken,
            ],
            Response::HTTP_CREATED
        );
    }


    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if (!$this->authService->checkAuthUser($data)) {
            return response()->json(['message' => 'Помилка аутентифікації'], Response::HTTP_UNAUTHORIZED);
        }

        [$token, $refreshToken] = $this->authService->createTokenForUser(Auth::user());

        return response()->json(
            [
                'message' => 'Success authentication',
                'token' => $token,
                'refreshToken' => $refreshToken,
            ],
            Response::HTTP_OK
        );
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->noContent();
    }

    public function refresh(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());

        $user = $token->tokenable;

        [$token, $refreshToken] = $this->authService->createTokenForUser($user);

        return response()->json(
            [
                'message' => 'Regenerated tokens',
                'token' => $token,
                'refreshToken' => $refreshToken,
            ],
            Response::HTTP_OK
        );
    }
}
