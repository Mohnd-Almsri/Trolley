<?php

namespace App\Http\Controllers;

use App\Http\Requests\addProductRequest;
use App\Http\Requests\addReviewRequest;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProductInfo(request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);
        $product=Product::where($request->product_id)->get()->first();
        if($product){
            $comment=Comment::where($request->product_id,'=','product_id')->where(auth()->user()->id,'=','user_id')->get()->first();
            if($comment){
                return response()->json([
                'status'=>1,
                'product' => $product,
                'comment'=>$comment]);
            }
            else{
                return response()->json([
                    'status'=>1,
                    'product' => $product,
                    'comment'=>null
                ]);
            }
        } else {
            return response()->json([
                'status'=>0,
                'message'=>'Product not found'
            ]);
        }
    }
    public function getFavoriteProducts(Request $request)
    {
        $favorites=User::find(auth()->user()->id)->favorites;
        return response()->json([
            'status'=>1,
            'favorites'=>$favorites
        ]);
    }
    public function addReview(addReviewRequest $request)
    {
        Comment::create([
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);
        $product = Product::where($request->product_id)->get()->first();
        $pr = $product->reviews * $product->reviews_count;
        $pr += $request->rating;
        $product->reviews_count++;
        $product->reviews = $pr / $product->reviews_count;
        $product->save();
        $store = Store::where($product->store_id, '=', 'store_id')->get()->first();
        $sr = $store->reviews * $store->reviews_count;
        $sr += $request->rating;
        $store->reviews_count++;
        $store->reviews = $sr / $store->reviews_count;
        $store->save();
    }
//    public function getProductForHome()
//    {
//        $products=Product::get();
//        $allProducts = Product::with('favorited') ->get() ->map(function ($products) { $product->is_favorite = $product->favorited->contains(auth()->user());
//            return response()->json([
//                'product' => $allProducts,
//            ]);
//        });
//    }
}
