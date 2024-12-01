<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerificationCodeRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\SendMessageTrait;

class VerificationCodeController extends Controller
{
    use SendMessageTrait;
    public function verification(VerificationCodeRequest $request){
$user = User::where('id','=',$request->id)->first();
if ($user){
    $user_code =User::where('verification_code','=',$request->code)->pluck('verification_code')->first();
    if ($user_code==$request->code){
        User::where('id','=',$request->id)->update([
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
    public function resendCode(Request $request){
    $request->validate([
        'id'=>'required|exists:users,id',
        'phoneNumber'=>'required'
    ]
    );
        $code=$this->verifyCodegenerate($request->id);
        $this->sendVerificationCode($request->phoneNumber,$code);
        return response()->json([
            'status'=>'success',
            'message'=>'Code Resend Successfully'
            ,'code'=>$code
        ]);


    }
}
