<?php

namespace App\Http\Controllers;

use App\Events\VerificationCode;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Traits\SendCodeTrait;
use HTTP_Request2;
use HTTP_Request2_Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use SendCodeTrait;
    public function index()
    {
        $users = User::all();
        return $users;
    }

    public function show($id)
    {


    }
    public function register(RegisterUserRequest $request){

         $user = User::create([
             'firstName' => $request->firstName,
             'lastName' => $request->lastName,
             'phoneNumber' => $request->phoneNumber,
             'password' => $request->password,
             'location' => $request->location,
         ]);
        $this->sendCode($user);



    }
    public function login(Request $request){
        $request->validate([
            'phoneNumber'=>'required',
            'password'=>'required'
        ]);
        $user = User::where('phoneNumber','=',$request->phoneNumber)->first();
                if ($user) {
            if($user->number_verification){
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken("auth_token")->plainTextToken;
                return response()->json([
                    'status'=>1,
                    'message'=>'Login Successfully',
                    'verified At'=>$user->number_verification,
                    'token'=>$token,
                ]);
            }
            else{
                return response()->json([
                    'status'=>0,
                    'message'=>'password did not match'
                ]);
            }}
            else{
                return response()->json([
                'status'=>0,
                'message'=>'User phone  did not verified'
            ]);}
        }
        else{
            return response()->json([
                'status'=>0,
                'message'=>'user Not Registered',
            ]);
        }
    }
    public function logout(){
        auth()->user()->tokens()->delete();
return response()->json([
    'status'=>1,
    'message'=>'Logout Successfully'
]);
    }
    public function sendCodeChangePassword(Request $request){

$request->validate([
    'phoneNumber' => 'required'
]);
$user = User::where('phoneNumber','=',$request->phoneNumber)->first();

if ($user) {
    $code= random_int(100000, 999999);

    $message = "Your reset Password code is $code";
    \App\Models\VerificationCode::create([
        'user_id' => $user->id,
        'code' => $code,
        'type' => 'password'
    ]);
    $params = [
        'token' => 'tp5y8x1r00h7ravq',
        'to' => $user->phoneNumber,
        'body' => $message
    ];

    $request = new HTTP_Request2();

    $request->setUrl('https://api.ultramsg.com/instance100514/messages/chat');
    $request->setMethod(HTTP_Request2::METHOD_POST);
    $request->setConfig([
        'follow_redirects' => true
    ]);
    $request->setHeader([
        'Content-Type' => 'application/x-www-form-urlencoded'
    ]);
    $request->addPostParameter($params);

    try {
        $response = $request->send();
        if ($response->getStatus() == 200) {
            return response()->json([
                'success' => true,
                'data' => $response->getBody(),
                'code' => $code,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unexpected HTTP status: ' . $response->getStatus() . ' ' . $response->getReasonPhrase()
            ]);
        }
    } catch (HTTP_Request2_Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }

                }
return response()->json([
    'success' => false,
    'message' => 'Phone Number Not Registered'
]);

    }

public function checkCodeChangePassword (Request $request)
{
    $request->validate([
        'phoneNumber' => 'required',
        'code' => 'required'

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
        'phoneNumber' => 'required',
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
