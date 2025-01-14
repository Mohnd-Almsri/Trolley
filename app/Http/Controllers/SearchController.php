<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchLetters(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);
        $products = Product::where('name', 'LIKE', '%' . $request->search . '%')->select(['id','name'])->take(7)->get();

        return response()->json([
            'status' => 1,
            'products' => $products,
            'message'=>'Products added successfully'
        ]);
    }
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);
        $products = Product::with(['store:id,name,image'])->where('name', 'LIKE', '%' . $request->search . '%')->get();
        return response()->json([
            'status' => 1,
            'products' => $products,
            'message'=>'Products added successfully'
        ]);
    }
}

