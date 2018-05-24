<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Route;

class AuthAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null)
    {
        $user_login_status = Session::get('user_login_status');
        if(!$user_login_status){
            session(['target_url'=>$request->url()]);
            return redirect()->route('passport.login');//没有登录状态，跳转到顶楼页面
            exit;
        }
        //自定义路由匹配 begin
        $url = $request->path();
        $url = preg_replace ("/\/\d+/","",$url);
        //dump($url);
        // if($url <> "/"){
            // $roleauthority = new \App\Models\RoleAuthorityModel();
            // $authority = new \App\Models\AuthorityModel();
            // $routeurl = [];
            // //dump(session('user_role'));
            // foreach(session('user_role') as $k => $v) {
                // $role_id = $roleauthority::where('role_id',$v)->pluck('authority_id');
                // //dump($role_id);
                // foreach($role_id as $k => $v){
                    // $authority_route = $authority::where('id',$v)->pluck('authority_route');
                    // $routeurl[] = $authority_route['0'];
                // }
            // }
            // //dump($routeurl);
            // if(!in_array($url,$routeurl)){
               // //dump("ok");
                // return redirect()->route('admin.index');//没有权限，跳转到顶楼页面
                // exit;
            // }
        // }
        //自定义路由end
        return $next($request);
    }
}
