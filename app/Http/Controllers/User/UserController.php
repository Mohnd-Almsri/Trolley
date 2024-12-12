<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Traits\SendMessageTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use SendMessageTrait;
    public function index()
    {
        return User::all();
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
        $code=$this->verifyCodegenerate($user->id);
        $this->sendVerificationCode($user->phoneNumber,$code);
        return response()->json([
            'user' => $user,
            'code' => $code,
        ]);
    }
    public function login(Request $request){
        $request->validate([
            'phoneNumber'=>'required',
            'password'=>'required|min:8'
        ]);
        $user = User::where('phoneNumber','=',$request->phoneNumber)->first();
                if ($user) {
            if(Hash::check($request->password, $user->password)){
            if ($user->number_verification) {
                $token = $user->createToken("auth_token")->plainTextToken;
                return response()->json([
                    'status'=>1,
                    'message'=>'Login Successfully',
                    'token'=>$token,
                ]);
            }
            else{

                return response()->json([
                    'status'=>0,
                    'message'=>'User phone  did not verified'
                ]);

            }}
            else{
                return response()->json([
                    'status'=>0,
                    'message'=>'password did not match'
                ]);
            }
        }
        else {
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
}
