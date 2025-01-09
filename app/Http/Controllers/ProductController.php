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
    public function addProduct(addProductRequest $request)
    {
        Product::create([$request->all()]);
        return response()->json(['message' => 'Product added successfully']);
    }
    public function getProductInfo(request $request)
    {
        $request->validate([
            'product_id' => 'required']);
        $product=Product::where('id','=',$request->product_id)->first();
        return response()->json(['status'=>1,'product'=>$product]);
    }
    public function getFavoriteProducts()
    {

        $favorites=User::find(auth()->id())->favorites;
        return response()->json([
            'status'=>1,
            'favorites'=>$favorites
        ]);
    }
    public function addReview(addReviewRequest $request){
        Comment::create($request->all());
        $product=Product::where('product_id')->get()->first();
        $pr=$product->reviews * $product->reviews_count;
        $pr+=$request->rating;
        $product->reviews_count++;
        $product->reviews=$pr/$product->reviews_count;
        $product->save();
        $store=Store::where($product->store_id,'=','store_id')->get()->first();
        $sr=$store->reviews * $store->reviews_count;
        $sr+=$request->rating;
        $store->reviews_count++;
        $store->reviews=$sr/$store->reviews_count;
        $store->save();
    }
    public function getRecommended()
    {
        $recProducts=Product::with(['store:id,name,image'])->orderBy('reviews','DESC')->take(10)->get();
        return response()->json(['status'=>1,'products'=>$recProducts]);
    }
    /*  public function searchProducts(request $request){
          $request->validate([
              'search' => 'required'
          ]);
          $products=Product::where('name','LIKE','%'.$request->search.'%')->take(15)->get();
          if($products){
          return response()->json([
              'status'=>1,
              'products' => $products,
              'message'=>'Products added successfully'
          ]);
          }else{
              return response()->json([
                  'status'=>0,
                  'message'=>'Products not found'
              ]);
          }
     } */
}
