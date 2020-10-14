<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\JWT\AuthController;
use App\Http\Middleware\ValidateJWT;
use App\Http\Controllers\API\V1\EntityController;
use App\Http\Controllers\API\V1\TicketController;
use App\Http\Controllers\API\V1\VoucherController;

Route::group(['prefix' => 'v1','middleware' => 'api'], function () {
    Route::group(['prefix' => 'auth'], function ($router) {
        Route::post('register', [AuthController::class, 'register'])->withoutMiddleware(ValidateJWT::class);
        Route::post('login', [AuthController::class, 'login'])->withoutMiddleware(ValidateJWT::class);
        Route::post('refresh', [AuthController::class, 'refresh'])->withoutMiddleware(ValidateJWT::class);
        Route::get('profile', [AuthController::class, 'profile']);
        Route::post('logout', [AuthController::class, 'logout']);
    });

    Route::group(['prefix' => 'entities'], function (){
        Route::get('/',[EntityController::class,'index'])->withoutMiddleware(ValidateJWT::class);
        Route::get('/offer-banner',[EntityController::class,'offerBanner'])->withoutMiddleware(ValidateJWT::class);
    });

    Route::group(['prefix' => 'tickets'], function (){
       Route::get('/',[TicketController::class,'index']);
    });

    Route::group(['prefix' => 'vouchers'], function (){
       Route::get('/',[VoucherController::class,'index']);
    });
});

