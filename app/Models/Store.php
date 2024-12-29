<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
protected $fillable = ['name','description','category_id'];
public function products(){
    return $this->hasMany(Product::class);
}
public function category(){
    return $this->belongsTo(Category::class);
}
}
