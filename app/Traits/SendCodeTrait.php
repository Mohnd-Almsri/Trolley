<?php

namespace App\Traits;

use App\Events\VerificationCode;

trait SendCodeTrait
{
public function sendCode($user){
    $code= random_int(100000, 999999);
    \App\Models\VerificationCode::create([
        'user_id' => $user->id,
        'code' => $code,
        'type' => 'verify'
    ]);
    event(new VerificationCode($user,$code));
    return response()->json([
        'user' => $user,
        'code' => $code,
    ]);
}
}
