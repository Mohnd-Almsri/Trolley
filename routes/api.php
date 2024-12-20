<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\VerificationCodeController;
use App\Http\Middleware\verificationMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\PasswordController;

Route::controller(PasswordController::class)->group(function () {
   Route::middleware([verificationMiddleware::class])->group(function () {
       Route::post('/resetPassword', 'sendCodeChangePassword');
       Route::post('/codeResetPassword',  'checkCodeChangePassword');
            Route::post('/resetPassword','changePassword');
   });
});

Route::controller(UserController::class)->group(function () {
    Route::get('/',[UserController::class,'index']);
    Route::post('/register', 'register');
    Route::get('/logout',  'logout')->middleware('auth:sanctum');
    Route::post('/login', 'login')->middleware(verificationMiddleware::class);
    Route::post('/update', 'update')->middleware('auth:sanctum');
    Route::post('/changePassword', 'changePassword')->middleware('auth:sanctum');

});

Route::controller(VerificationCodeController::class)->group(function () {
    Route::post('/reSendCode','resendCode');
Route::post('/verification',  'verification');

});
Route::controller(StoreController::class)->group(function () {
    Route::post('/store', 'StoreInfo');
});
Route::controller(ProductController::class)->group(function () {
    Route::post('/review', 'addReview');
});
Route::controller(OrderController::class)->group(function () {
    Route::post('/createOrder', 'createOrder')->middleware('auth:sanctum');
    Route::get('/userOrders', 'userOrders')->middleware('auth:sanctum');
    Route::post('/deleteOrder', 'deleteOrder')->middleware('auth:sanctum');
    Route::post('/UpdateOrder', 'UpdateOrder')->middleware('auth:sanctum');
});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
