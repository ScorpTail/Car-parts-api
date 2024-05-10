<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
 
    return ['token' => $token->plainTextToken];
});

Route::group(['as' => 'auth.', 'controller' => AuthController::class], function () {

    Route::post('/register', 'register')->middleware('guest:sanctum')->name('register');

    Route::post('/login', 'login')->middleware('guest:sanctum')->name('login');

    Route::post('/logout', 'logout')->middleware(['auth:sanctum'])->name('logout');
});