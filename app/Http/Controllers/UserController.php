<?php

namespace App\Http\Controllers;

use App\Events\VerificationCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return $users;
    }

    public function show($id)
    {


    }
    public function register(Request $request){
         $request->validate([
             'firstName' => 'required',
             'lastName' => 'required',
             'phoneNumber' => 'required|unique:users|min:10',
             'password' => 'required|min:8|confirmed',
             'location' => 'required',
         ]);
         $user = User::create([
             'firstName' => $request->firstName,
             'lastName' => $request->lastName,
             'phoneNumber' => $request->phoneNumber,
             'password' => $request->password,
             'location' => $request->location,
         ]);
event(new VerificationCode($user));
return response()->json([
    'user' => $user,

]);

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
    public function changePassword(Request $request){




    }



}
