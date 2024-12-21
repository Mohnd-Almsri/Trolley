<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);
        $products = Product::where('name', 'LIKE', '%' . $request->search . '%')->take(15)->get();
        $stores = Store::where('name', 'LIKE', '%' . $request->search . '%')->take(5)->get();
        return response()->json([
            'status' => 1,
            'products' => $products,
            'stores' => $stores,
            'message'=>'Products added successfully'
        ]);
    }
}

