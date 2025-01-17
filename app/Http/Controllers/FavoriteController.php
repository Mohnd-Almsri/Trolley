<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    public function addFavorite(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'is_favorite' => 'boolean|required'
        ]);
        if($request->is_favorite==true){
            Favorite::where('user_id','=',auth()->user()->id)->where('product_id','=',$request->product_id)->delete();
            return response()->json([
                'status' => 1,
                'message' => 'Favorite removed successfully'
            ]);}
        {
            Favorite::firstOrCreate(['user_id' => auth()->user()->id, 'product_id' => $request->product_id], $request->all());
            return response()->json([
                'status' => 1,
                'message' => 'Favorite added successfully'
            ]);
        }
    }
//    public function removeFavorite(Request $request)
//    {
//        $request->validate([
//            'product_id' => 'required|integer|exists:products,id',
//        ]);
//        Favorite::where('user_id','=',auth()->user()->id)->where('product_id','=',$request->product_id)->delete();
//        return response()->json([
//            'status' => 1,
//            'message' => 'Favorite removed successfully'
//        ]);
//    }
}
