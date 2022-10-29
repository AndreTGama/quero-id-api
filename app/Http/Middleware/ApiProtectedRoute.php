<?php

namespace App\Http\Middleware;

use App\Builder\ReturnMessage;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;


class ApiProtectedRoute extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        try {
            $user = FacadesJWTAuth::parseToken()->authenticate();

            if($user->type_user_id != $role) {
                throw new \Exception('User not allowed.');
            }

        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return ReturnMessage::message(
                    false,
                    'Token is Invalid',
                    'Token is Invalid',
                    null,
                    null,
                    401
                );
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return ReturnMessage::message(
                    false,
                    'Token is Expired',
                    'Token is Expired',
                    null,
                    null,
                    401
                );
            }else if($e){
                return ReturnMessage::message(
                    false,
                    $e->getMessage(),
                    $e->getMessage(),
                    null,
                    null,
                    401
                );
            }else{
                return ReturnMessage::message(
                    false,
                    'Authorization Token not found',
                    'Authorization Token not found',
                    null,
                    null,
                    401
                );
            }
        }
        return $next($request);
    }
}
