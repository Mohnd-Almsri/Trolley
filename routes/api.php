<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\VerificationCodeController;
use App\Http\Middleware\verificationMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\PasswordController;

Route::get('/',[UserController::class,'index']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/resendcode', [VerificationCodeController::class, 'resendCode']);
Route::post('/login', [UserController::class, 'login'])->middleware(verificationMiddleware::class);
Route::post('/resetPassword', [PasswordController::class, 'sendCodeChangePassword'])->middleware(verificationMiddleware::class);
Route::post('/codeResetPassword', [PasswordController::class, 'checkCodeChangePassword'])->middleware(verificationMiddleware::class);
Route::post('/changePassword', [PasswordController::class, 'changePassword'])->middleware(verificationMiddleware::class);
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/verification', [VerificationCodeController::class, 'verification']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
