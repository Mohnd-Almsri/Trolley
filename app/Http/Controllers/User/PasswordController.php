<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\SendMessageTrait;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    use SendMessageTrait;
    public function sendCodeChangePassword(Request $request){

        $request->validate([
            'phoneNumber' => 'required|min:10|max:10',
        ]);
        $user = User::where('phoneNumber','=',$request->phoneNumber)->first();

        if ($user) {
            $code=$this->verifyCodegenerate($user->id);
            $this->sendVerificationCode($user->phoneNumber,$code);
        }
        return response()->json([
            'success' => false,
            'message' => 'Phone Number Not Registered'
        ]);

    }

    public function checkCodeChangePassword (Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required|min:10|max:10',
            'code' => 'required|min:6|max:6',
        ]);
        $user = User::where('phoneNumber','=',$request->phoneNumber)->first();
            $user_code = \App\Models\VerificationCode::where('user_id','=',$user->id)->where('type','=','password')->pluck('code')->first();
        if ($user_code==$request->code){
            User::where('phoneNumber','=',$request->phoneNumber)->update(['passwordReset'=>1]);
            return response()->json([
                'status'=>'success',
                'message'=>'Code Verified Successfully']);
        }
        else{return response()->json([
            'status'=>'failed',
            'message'=>'Code  did not verify']);
        }
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required|min:10|max:10',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('phoneNumber','=',$request->phoneNumber)->first();
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
            'message'=>'Phone Number Not Registered'
        ]);
    }

}
