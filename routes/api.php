<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::get('/user', fn (Request $request) => $request->user())
    ->middleware('auth:sanctum');

Route::group(['as' => 'auth.', 'controller' => AuthController::class], function () {

    Route::post('/register', 'register')
        ->middleware('guest:sanctum')
        ->name('register');

    Route::post('/login', 'login')
        ->middleware('guest:sanctum')
        ->name('login');

    Route::post('/logout', 'logout')
        ->middleware(['auth:sanctum'])
        ->name('logout');

    Route::post('/refresh', 'refresh')
        ->middleware(['auth:sanctum', 'ability:refreshToken'])
        ->name('refresh');
});
