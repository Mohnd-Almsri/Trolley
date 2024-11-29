<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationCodeController;
use App\Http\Middleware\verificationMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login'])->middleware(verificationMiddleware::class);
Route::post('/resetPassword', [UserController::class, 'sendCodeChangePassword'])->middleware(verificationMiddleware::class);
Route::post('/codeResetPassword', [UserController::class, 'checkCodeChangePassword'])->middleware(verificationMiddleware::class);
Route::post('/changePassword', [UserController::class, 'changePassword'])->middleware(verificationMiddleware::class);
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/verification', [VerificationCodeController::class, 'verification']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
