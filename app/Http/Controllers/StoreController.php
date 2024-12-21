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

        $stores=Store::where($request->category_id,'=','category_id')->get();
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

    public function addStore(Request $request){
        $request->validate([
            'name' => 'required|unique:stores',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            ]);
        Store::create($request->all());
        return response()->json([
            'status'=>1,
            'message'=>'store created successfully'
        ]);
    }
    /*public function searchStores(request $request){
    $request->validate([
        'search' => 'required'
    ]);
    $stores=Store::where('name','LIKE','%'.$request->search.'%')->take(5)->get();
    if($stores){
        return response()->json([
            'status'=>1,
            'stores' => $stores,
            'message'=>'stores added successfully'
        ]);
    }else{
        return response()->json([
            'status'=>0,
            'message'=>'stores not found'
        ]);
    }
}*/

}
