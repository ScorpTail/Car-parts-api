<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Brand\BrandController;
use App\Http\Controllers\Garage\GarageController;
use App\Http\Controllers\Search\SerachController;
use App\Http\Controllers\CarPart\CarPartController;
use App\Http\Controllers\CarModel\CarModelController;
use App\Http\Controllers\Favorite\FavoriteController;

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


Route::group(['as.' => 'user.', 'prefix' => 'user', 'controller' => UserController::class], function () {
    Route::get('{user}', 'showUserProfile')->name('showProfile');

    Route::get('/', 'showCurrentUser')->name('showCurrentUser')->middleware('auth:sanctum');

    Route::post('{user}', 'updateUserProfile')->name('updateProfile')->middleware('auth:sanctum');
});

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'user/garage', 'controller' => GarageController::class], function () {
    Route::get('all', 'index');
    Route::post('/{carModel}', 'store');
    Route::delete('/', 'destroy');
});

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'user/favorite', 'controller' => FavoriteController::class], function () {
    Route::get('all', 'index');
    Route::post('/{carPart}', 'store');
    Route::delete('/', 'destroy');
});

Route::get('/getImage/{fileName}', ImageController::class)->where('fileName', '.*');;

Route::get('/search', SerachController::class);

Route::apiResource('brand', BrandController::class)->only(['index', 'show']);

Route::apiResource('model', CarModelController::class)->only(['index', 'show']);

Route::apiResource('part', CarPartController::class)->only(['index', 'show']);
