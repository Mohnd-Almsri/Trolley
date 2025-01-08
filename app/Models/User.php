<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,hasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'phoneNumber',
        'location',
        'password',
        'profilePic',
        'passwordReset'

    ];

    public function profilePic(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url(Storage::url($value)),
        );
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_code',
        'number_verification',
        'passwordReset',
        'verification_code_expires_at',
        'created_at',
        'updated_at'
    ];
    public function favorites(){
        return $this->belongsToMany(Product::class,'favorites','user_id','product_id');
    }
    /**
     * Get the attributes that should be cast
     *
     * @return array<string, string>
     */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

}

