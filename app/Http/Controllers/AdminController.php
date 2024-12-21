<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addAdminToStore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'storeName' => 'required|string|max:255',
            'storeDescription' => 'required|string|max:500',
            'category' => 'required|string|max:255',
            'role' => 'required|string|max:100',
        ]);

        $category = Category::firstOrCreate(
            ['name' => $request->category],
            ['name' => $request->category]
        );

        $store = Store::firstOrCreate(
            ['name'=> $request->storeName]
            ,[ 'name' => $request->storeName,
            'description' => $request->storeDescription,
            'category_id' => $category->id]);

        Admin::create([
            'user_id' => $request->user_id,
            'store_id' => $store->id,
            'role' => $request->role,
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'Admin added successfully.',
        ]);
    }
    public function deleteAdminFromStore(Request $request){
        $request->validate([
            'admin_id' => 'required|exists:admins,id',
        ]);
        $superAdmin = Admin::where('role','=','super-admin')->first();
        if($superAdmin){
            if($superAdmin->id!=$request->admin_id){

                Admin::where('id',$request->admin_id)->delete();
                return response()->json([
                    'status' => 1,
                    'message' => 'Admin deleted successfully.',
                ]);
            }
            return response()->json(['status' => 0,
            'message '=> 'you can\'t delete super-admin '
            ]);
        }
        return response()->json([
            'status' => 0,
            'message' => 'you are not allowed to delete admin.',
        ]);
    }
    public function addProductToStore(Request $request){
        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'productName' => 'required|string|max:255',
            'productDescription' => 'required|string|max:500',
            'productPrice' => 'required|string|max:255',
            'productQuantity' => 'required|string|max:255',
            ]);
        $admin = Admin::where('user_id','=',auth()->user()->id)
            ->where('store_id','=',$request->store_id)->first();
    if($admin){
        Product::create([
            'store_id' => $admin->store_id,
            'name' => $request->productName,
            'description'=>$request->productDescription,
            'price'=>$request->productPrice,
            'quantity'=> $request->productQuantity
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'Product added successfully.',
        ]);
    }
    return response()->json([
        'status' => 0,
        'message' => 'you are not authorized to add this product.',
    ]);
}
    public function deleteProductFromStore(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::find($request->product_id);
        $admin = Admin::where('user_id', auth()->user()->id)
            ->where('store_id', $product->store_id)
            ->first();

        if ($admin) {
            $product->delete();

            return response()->json([
                'status' => 1,
                'message' => 'Product deleted successfully.',
            ]);
        }

        return response()->json([
            'status' => 0,
            'message' => 'You are not authorized to delete this product.',
        ]);
    }
    public function updateProduct(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $product = Product::find($request->product_id);

        $admin = Admin::where('user_id', auth()->id())
            ->where('store_id', $product->store_id)
            ->first();

        if ($admin) {
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'quantity' => $request->quantity,
            ]);

            return response()->json([
                'status' => 1,
                'message' => 'Product updated successfully.',
            ]);
        }

        return response()->json([
            'status' => 0,
            'message' => 'You are not authorized to update this product.',
        ]);
    }

    public function getAdmins(){
        $admins = Admin::all();
        return response()->json([
            'status' => 1,
            'admins' => $admins,
        ]);
    }
    public function getProducts(){
    if(Admin::find(auth()->user()->id)){
        $products = Product::where('store_id','=',auth()->user()->admin->store_id)->get();
        return response()->json([
            'status' => 1,
            'products' => $products,

        ]);
    }
    return response()->json([
        'status' => 0,
        'message' => 'you are not authorized to view products.']);
    }
}
