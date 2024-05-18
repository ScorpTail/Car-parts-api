<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Brand\BrandController;
use App\Http\Controllers\Image\ImageController;
use App\Http\Controllers\Photo\PhotoController;
use App\Http\Controllers\CarPart\CarPartController;
use App\Http\Controllers\CarModel\CarModelController;

Route::get('/user', fn (Request $request) => $request->user())
    ->middleware('auth:sanctum');

Route::get('/getImage/{fileName}', ImageController::class);

Route::group(['as' => 'auth.', 'controller' => AuthController::class], function () {

    Route::post('/register', 'register')
        ->middleware('guest')
        ->name('register');

    Route::post('/login', 'login')
        ->middleware('guest')
        ->name('login');

    Route::post('/logout', 'logout')
        ->middleware(['auth:sanctum'])
        ->name('logout');

    Route::post('/refresh', 'refresh')
        ->middleware(['auth:sanctum', 'ability:refreshToken'])
        ->name('refresh');
});

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'user/favorite', 'controller' => FavoriteController::class], function () {
    Route::get('all', 'index');
    Route::post('/{carPart}', 'store');
    Route::delete('/', 'destroy');
});

Route::apiResource('brand', BrandController::class)->only(['index', 'show']);
Route::apiResource('model', CarModelController::class)->only(['index', 'show']);
Route::apiResource('part', CarPartController::class)->only(['index', 'show']);
