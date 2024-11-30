<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class verificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

          $user =User::where('phoneNumber','=',$request->phoneNumber)->first(); ;

        if($user){
            if($user->number_verification==0||$user->number_verification==1){
                return response()->json([
                    'status' => '0',
                    'message' => 'your phone number did not verify'
                ]);
            }
        }
        else{
            return response()->json([
                'status' => '0',
                'message' => 'Phone Number Not ئءRegistered'

            ]);
        }

        return $next($request);
    }
}
