<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\JWT\AuthController;
use App\Http\Middleware\ValidateJWT;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('register', [AuthController::class,'register'])->withoutMiddleware(ValidateJWT::class);
    Route::post('login', [AuthController::class,'login'])->withoutMiddleware(ValidateJWT::class);
    Route::post('refresh', [AuthController::class,'refresh'])->withoutMiddleware(ValidateJWT::class);
    Route::get('profile', [AuthController::class,'profile']);
    Route::post('logout', [AuthController::class,'logout']);
});
