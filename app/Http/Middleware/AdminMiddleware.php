<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin = Admin::where('user_id','=',auth()->user()->id)->where('store_id','=',);
        if($admin || (Admin::where('user_id', '=', auth()->user()->id)->where('role', '=', 'Super-Admin')->exists())) {
            return $next($request);
        }
        return response()->json([
            'status' => 0,
            'message' => 'You are not authorized to do this action.',
        ]);

    }
}
