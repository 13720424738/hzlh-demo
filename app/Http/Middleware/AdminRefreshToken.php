<?php

namespace App\Http\Middleware;

// use App\Entities\Admin\Admin;
use Modules\Crew\Entities\Crew\Crew;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class CrewRefreshToken extends BaseMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|mixed
     * @throws JWTException
     */

    public function handle($request, Closure $next)
    {
        // 检查此次请求中是否带有 token，如果没有则抛出异常。
        $authToken = Auth::guard('crew')->getToken();
        if(!$authToken){
            	return response(['code'=>401,'msg'=>'Token not provided'],401);
        }

        // 检测用户的登录状态，如果正常则通过
        if (Auth::guard('crew')->check()) {
            $crew_id = Auth::guard('crew')->payload()['sub'];
            $time = Auth::guard('crew')->payload()['exp'];

            //刷新Token
            if(($time - time()) < 10*60 && ($time - time()) > 0){
                $token = Auth::guard('crew')->refresh();
                if($token){
                    $request->headers->set('Authorization', 'Bearer '.$token);
                }else{
					return response(['code'=>401,'msg'=>'The token has been blacklisted'],401);
                }

                // 在响应头中返回新的 token
                $respone = $next($request);
                if(isset($token) && $token){
                    $respone->headers->set('Authorization', 'Bearer '.$token);
                }
                return $respone;
            }

            //token通过验证 执行下一补操作
            return $next($request);
        }
		return response(['code'=>401,'msg'=>'The token has been blacklisted'],401);
    }
}
