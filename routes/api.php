<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\VerificationCodeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\verificationMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\PasswordController;
use App\Http\Controllers\SearchController;

Route::controller(PasswordController::class)->group(function () {
   Route::middleware([verificationMiddleware::class])->group(function () {
       Route::post('/sendCodeResetPassword', 'sendCodeChangePassword');
       Route::post('/codeResetPassword',  'checkCodeChangePassword');
       Route::post('/resetPassword','reset\Password');
   });
});

Route::controller(UserController::class)->group(function () {
    Route::get('/',[UserController::class,'index']);
    Route::post('/register', 'register');
    Route::get('/logout',  'logout')->middleware('auth:sanctum');
    Route::post('/login', 'login')->middleware(verificationMiddleware::class);
    Route::post('/update', 'update')->middleware('auth:sanctum');
    Route::post('/changeProfileImage', 'changeProfileImage')->middleware('auth:sanctum');
    Route::post('/changeLocation', 'changeLocation')->middleware('auth:sanctum');
    Route::get('/userInfo', 'userInfo')->middleware('auth:sanctum');
    Route::post('/changePassword', 'changePassword')->middleware('auth:sanctum');
});

Route::controller(VerificationCodeController::class)->group(function () {
    Route::post('/reSendCode','resendCode');
Route::post('/verification',  'verification');

});
Route::controller(StoreController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/StoreInfo', 'StoreInfo');
    Route::post('/StoresForCategory', 'StoresForCategory');
});
Route::controller(ProductController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/getProductInfo', 'getProductInfo');
    Route::post('/addReview', 'addReview');
    Route::get('/getFavoriteProducts', 'getFavoriteProducts');
    Route::get('/getProductForHome', 'getProductForHome');
    Route::get('/getRecommended', 'getRecommended');
});

Route::controller(SearchController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/searchLetters', 'searchLetters');
    Route::get('/search', 'searchLetters');
});

Route::controller(AdminController::class)->middleware('auth:sanctum')->group(function () {
    Route::post('/addAdminToStore', 'addAdminToStore');
    Route::post('/deleteAdminFromStore', 'deleteAdminFromStore');
    Route::get('/getAdmins', 'getAdmins');
    Route::get('/getStore', 'getStore');
    Route::post('/changeAdmin', 'changeAdmin');

    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::post('/addProductToStore', 'addProductToStore');
        Route::post('/deleteProductFromStore', 'deleteProductFromStore');
        Route::post('/updateProduct', 'updateProduct');
        Route::post('/updateStore', 'updateStore');
        Route::post('/updateStoreImage', 'updateStoreImage');
        Route::post('/updateProductImage', 'updateProductImage');

    });


});
Route::controller(OrderController::class)->middleware('auth:sanctum')->group(function () {
    Route::post('/createOrder', 'createOrder');
    Route::get('/userOrders', 'userOrders');
    Route::post('/deleteOrder', 'deleteOrder');
    Route::post('/updateOrder', 'updateOrder');
});
Route::controller(FavoriteController::class)->middleware('auth:sanctum')->group(function () {
    Route::post('/addFavorite', 'addFavorite');
    Route::post('/removeFavorite', 'removeFavorite');
});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
