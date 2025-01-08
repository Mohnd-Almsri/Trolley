<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $product=Product::where('id','=',1)->first();
    return response()->json(['status'=>1,'product'=>$product]);
});
