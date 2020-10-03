<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\JWT\AuthController;
use App\Http\Middleware\ValidateJWT;
use App\Http\Controllers\API\EntityController;

Route::group(['prefix' => 'v1'], function () {
    Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
        Route::post('register', [AuthController::class, 'register'])->withoutMiddleware(ValidateJWT::class);
        Route::post('login', [AuthController::class, 'login'])->withoutMiddleware(ValidateJWT::class);
        Route::post('refresh', [AuthController::class, 'refresh'])->withoutMiddleware(ValidateJWT::class);
        Route::get('profile', [AuthController::class, 'profile']);
        Route::post('logout', [AuthController::class, 'logout']);
    });

    Route::group(['prefix' => 'entities'], function (){
        Route::get('/',[EntityController::class,'index']);
        Route::get('/offer-banner',[EntityController::class,'offerBanner']);
    });
});

