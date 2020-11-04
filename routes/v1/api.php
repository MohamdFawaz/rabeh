<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\JWT\AuthController;
use App\Http\Middleware\ValidateJWT;
use App\Http\Controllers\API\V1\EntityController;
use App\Http\Controllers\API\V1\TicketController;
use App\Http\Controllers\API\V1\VoucherController;
use App\Http\Controllers\API\V1\TraderController;
use App\Http\Controllers\API\V1\PointController;

Route::group(['prefix' => 'v1','middleware' => 'api'], function () {
    Route::group(['prefix' => 'auth'], function ($router) {
        Route::post('register', [AuthController::class, 'register'])->withoutMiddleware(ValidateJWT::class);
        Route::post('register-as-trader', [AuthController::class, 'registerAsTrader'])->withoutMiddleware(ValidateJWT::class);
        Route::post('login', [AuthController::class, 'login'])->withoutMiddleware(ValidateJWT::class);
        Route::post('refresh', [AuthController::class, 'refresh'])->withoutMiddleware(ValidateJWT::class);
        Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->withoutMiddleware(ValidateJWT::class);
        Route::post('profile', [AuthController::class, 'profile']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('referral-code', [AuthController::class, 'referralCode']);
    });

        Route::group(['prefix' => 'entities'], function (){
            Route::get('/',[EntityController::class,'index'])->withoutMiddleware(ValidateJWT::class);
            Route::get('/offer-banner',[EntityController::class,'offerBanner'])->withoutMiddleware(ValidateJWT::class);
        });

        Route::group(['prefix' => 'tickets'], function (){
           Route::get('/',[TicketController::class,'index']);
           Route::post('/redeem',[TicketController::class,'redeemTicket']);
        });

        Route::group(['prefix' => 'vouchers'], function (){
           Route::get('/',[VoucherController::class,'index']);
           Route::post('/redeem',[VoucherController::class,'redeemVoucher']);
        });

        Route::group(['prefix' => 'trader'],function (){
           Route::post('/exchange-cash',[TraderController::class,'exchangeCash']);
        });

        Route::group(['prefix' => 'points'],function (){
           Route::post('/redeem',[PointController::class,'redeemPoints']);
        });

    Route::get('/test-notification/{id?}',[AuthController::class,'testNotification']);


});


