<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function StoreInfo(Request $request)
    {
        $request->validate(['store_id' => 'required']);
        $store=Store::where('id','=',$request->store_id)->with('products')->first();
        if($store){
        return response()->json([
            'status'=>1,
            'store'=>$store,
            'message'=>'Store Found'
            ]);
        }
        else{
            return response()->json([
                'status'=>0,
                'message'=>'Store Not Found'
            ]);
        }
    }
    public function StoresForCategory(Request $request){
        $request->validate(['category_id' => 'required']);
        $stores=Store::where('category_id','=',$request->category_id)->get();
        if($stores){
        return response()->json([
            'status'=>1,
            'stores'=>$stores,
            'message'=>'Stores Found'
        ]);}
        else{
            return response()->json([
                'status'=>0,
                'message'=>'Stores Not Found'
            ]);
        }
    }



}
