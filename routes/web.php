<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/auth/reset-password',[AuthController::class,'resetPassword'])->name('web.resetPasswordForm');
Route::post('/auth/reset-password',[AuthController::class,'updatePassword']);

Route::get('/auth/verify-email',[AuthController::class,'verifyEmail'])->name('web.verifyEmail');
