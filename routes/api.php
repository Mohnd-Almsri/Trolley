<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\VerificationCodeController;
use App\Http\Middleware\verificationMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\PasswordController;
use App\Http\Controllers\SearchController;

Route::controller(PasswordController::class)->group(function () {
   Route::middleware([verificationMiddleware::class])->group(function () {
       Route::post('/sendCodeResetPassword', 'sendCodeChangePassword');
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
    Route::post('/changeProfileImage', 'changeProfileImage')->middleware('auth:sanctum');
    Route::get('/userInfo', 'userInfo')->middleware('auth:sanctum');
    Route::post('/changePassword', 'changePassword')->middleware('auth:sanctum');

});

Route::controller(VerificationCodeController::class)->group(function () {
    Route::post('/reSendCode','resendCode');
Route::post('/verification',  'verification');

});
Route::controller(StoreController::class)->group(function () {
    Route::get('/storeInfo', 'StoreInfo');
    Route::get('/StoresForCategory', 'StoresForCategory');
    Route::post('/addStore', 'addStore');
//    Route::get('/searchStores', 'searchStores');
});
Route::controller(ProductController::class)->group(function () {
    Route::get('/getProductInfo', 'getProductInfo');
    Route::post('/addReview', 'addReview');
    Route::get('/getFavoriteProducts', 'getFavoriteProducts');
//    Route::get('/searchProducts', 'searchProducts');
});

Route::controller(\App\Http\Controllers\SearchController::class)->group(function () {
    Route::get('/search', 'search');
});

Route::controller(AdminController::class)->middleware('auth:sanctum')->group(function () {
    Route::post('/addAdminToStore', 'addAdminToStore');
    Route::post('/addProductToStore', 'addProductToStore');
    Route::post('/deleteAdminFromStore', 'deleteAdminFromStore');
    Route::post('/deleteProductFromStore', 'deleteProductFromStore');
    Route::post('/updateProduct', 'updateProduct');
    Route::post('/updateStore', 'updateStore');
    Route::post('/updateStoreImage', 'updateStoreImage');
    Route::post('/updateProductImage', 'updateProductImage');
    Route::get('/getAdmins', 'getAdmins');
    Route::get('/getStore', 'getStore');
    Route::post('/changeAdmin', 'changeAdmin');
});
Route::controller(OrderController::class)->middleware('auth:sanctum')->group(function () {
    Route::post('/createOrder', 'createOrder');
    Route::get('/userOrders', 'userOrders');
    Route::post('/deleteOrder', 'deleteOrder');
    Route::post('/updateOrder', 'updateOrder');
});
Route::controller(FavoriteController::class)->group(function () {
    Route::post('/addFavorite', 'addFavorite');
    Route::post('/removeFavorite', 'removeFavorite');
});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
