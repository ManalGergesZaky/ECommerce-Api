<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class check
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try{
            if (!$request->bearerToken()) {
                return response()->json(['status' => 'Token not provided'], 400);
            }
            $user = JWTAuth::parseToken()->authenticate();
        }
        catch(\Exception $e){
            if($e instanceof TokenInvalidException) {
                return response()->json(['status'=>'token is invalid']) ;
            }
            else if($e instanceof TokenExpiredException) {
                return response()->json(['status' =>'token is expired']) ;
            }
            else {
                return response()->json([
                    'status:'=> 'Erro!', 
                    'msg'=>$e->getMessage(),
                    ]) ;
            }
        }
        return $next($request);
    }
}
