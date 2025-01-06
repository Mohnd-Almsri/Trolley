<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'store_id',
        'image'
    ];
    public function favorited() {
        return $this->belongsToMany(User::class, 'favorites');}
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }
}
