<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\SendMessageTrait;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    use SendMessageTrait;

    //تابع نرسل له الرقم لتغيير كلمة السر
    public function sendCodeChangePassword(Request $request){

        $request->validate([
            'phoneNumber' => 'required|min:10|max:10',
        ]);
        $user = User::where('phoneNumber','=',$request->phoneNumber)->first();

        if ($user) {
            $code=$this->verifyCodegenerate($user->id);
            $this->sendPasswordCode($user->phoneNumber,$code);
            return response()->json([
                'status'=> 1,
                'code'=>$code]);
        }
        return response()->json([
            'status' => 0,
            'message' => 'Phone Number Not Registered'
        ]);

    }
    //للتاكد من الكود المرسل
    public function checkCodeChangePassword (Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required|min:10|max:10',
            'code' => 'required|min:6|max:6',
        ]);
        $user = User::where('phoneNumber','=',$request->phoneNumber)->first();
        if ($user) {
            $user_code =User::where('verification_code','=',$request->code)->pluck('verification_code')->first();
            if ($user_code==$request->code){
                User::where('phoneNumber','=',$request->phoneNumber)->update(['passwordReset'=>1]);
                return response()->json([
                    'status'=>1,
                    'message'=>'Code Verified Successfully']);
            }
            else{return response()->json([
                'status'=>0,
                'message'=>'Code is incorrect']);
            }
        }
        else {
            return response()->json([
                'status'=>0,
                'message'=>'Phone Number Not Registered'
            ]);
        }

    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required|min:10|max:10',
            'password' => 'required|min:8|confirmed',
        ]);


        $user = User::where('phoneNumber','=',$request->phoneNumber)->first();
        if ($user) {
            if ($user->passwordReset==1) {
            $user->update([
                'passwordReset'=>0,
                'password'=>$request->password
            ]);
            return response()->json([
                'status'=>1,
                'message'=>'Password Changed Successfully'
            ]);
        }
            return response()->json([
                'status'=>0,
                'message'=>'you can not change your password'
            ]);
        }
        else{return response()->json([
        'status'=>0,
     'message'=>'Phone Number Not Registered'
        ]);
            }
    }


}
