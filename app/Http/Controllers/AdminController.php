<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
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

}
