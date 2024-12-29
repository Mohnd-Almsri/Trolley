<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
trait StoreImage
{

    public function updateImage(Request $request, $modelName)
    {
        $request->validate([
            'id' => $modelName==='User' ? 'nullable' : 'required',
        'image' => 'required|image'
        ]);

        $modelName1=$modelName;
        $modelName = 'App\\Models\\' . $modelName;
        if($modelName1=='User')
            $model = $modelName::find(auth()->user()->id);
        else
        $model = $modelName::where('id',$request->id)->first();

if ($model) {
    $imageName = str_replace(' ', '_', $model->name);

    $imagePath = $modelName1 === 'Store'
        ? $request->file('image')->storeAs(
            'Stores/' .$model->category->name.'/'. $imageName,
            $imageName . '.' . $request->file('image')->getClientOriginalExtension(),
            'public'
        )
        : ($modelName1 === 'Product'
            ? $request->file('image')->storeAs(
                'Stores/' .$model->store->category->name .'/'. str_replace(' ', '_', $model->Store->name).  '/Products',
                $imageName  . '.' . $request->file('image')->getClientOriginalExtension(),
                'public'
            )
            : ($modelName1 === 'User'
                ? $request->file('image')->storeAs(
                    'Users',
                    $model->id . '.' . $request->file('image')->getClientOriginalExtension(),
                    'public'
                )
                : null
            )
        );
if($modelName1=='User')
    $model->update(['profilePic' => $imagePath]);
    else
        $model->update(['image' => $imagePath]);

            return response()->json([
                'status' => 1,
                'message' => 'Image uploaded and updated successfully.',
                'image_path' => $imagePath,
            ]);
        }

        return response()->json([
            'status' => 0,
            'message' => 'Model not found.',
        ], 404);
    }

}
