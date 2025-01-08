<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
protected $hidden = [
    "created_at",
    "updated_at"
];
    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url(Storage::url($value)),
        );
    }

    public function favorited() {
        return $this->belongsToMany(User::class, 'favorites');}
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }
}
