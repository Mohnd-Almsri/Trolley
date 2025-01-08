<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Store extends Model
{
protected $fillable = ['name','description','category_id','image'];

protected $hidden = [
    'created_at',
    'updated_at',

];
    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url(Storage::url($value)),
        );
    }
public function products(){
    return $this->hasMany(Product::class);
}
public function category(){
    return $this->belongsTo(Category::class);
}
}
