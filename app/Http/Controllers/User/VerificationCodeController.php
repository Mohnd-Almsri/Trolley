<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerificationCodeRequest;
use App\Models\User;
use App\Models\VerificationCode;

class VerificationCodeController extends Controller
{
    public function verification(VerificationCodeRequest $request){
$user = User::where('id','=',$request->user_id)->first();
if ($user){
    $user_code =User::where('verification_code','=',$request->code)->pluck('verification_code')->first();
    if ($user_code==$request->code){
        User::where('id','=',$request->user_id)->update([
            'verification_code'=>null,
            'number_verification'=>now()]);
        return response()->json([
            'status'=>'success',
            'message'=>'Code Verified Successfully']);
    }
    else{return response()->json([
        'status'=>'failed',
        'message'=>'Code  is incorrect']);
    }

}
else{return response()->json([
    'status'=>'failed',
    'message' => 'Phone Number Not Registered'
]);}

    }
}
