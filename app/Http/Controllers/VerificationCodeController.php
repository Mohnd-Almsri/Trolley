<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerificationCodeRequest;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;

class VerificationCodeController extends Controller
{
    public function verification(VerificationCodeRequest $request){

       $user_code = VerificationCode::where('user_id','=',$request->user_id)->where('type','=','verify')->pluck('code')->first();
        if ($user_code==$request->code){
            User::where('id','=',$request->user_id)->update(['number_verification'=>now()]);
        return response()->json([
            'status'=>'success',
            'message'=>'Code Verified Successfully']);
        }
        else{return response()->json([
            'status'=>'failed',
            'message'=>'Code  did not verify']);
        }

    }
}
