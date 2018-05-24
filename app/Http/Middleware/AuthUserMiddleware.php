<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AuthUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user_login_status = Session::get('user_login_status');
        if(!$user_login_status){
            session(['target_url'=>$request->url()]);
            return redirect()->route('u.login');//没有登录状态，跳转到顶楼页面
            exit;
        }
        return $next($request);
    }
}
