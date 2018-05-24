<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\News;

class AuthWeixinMiddleware
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
//        //获取微信用户信息
        if(is_weixin())://微信内浏览时执行微信接口
            $options = get_wechat_options();
            $app = new Application($options);
            $oauth = $app->oauth;
            if(!session()->has('wechat_user')):
                session(['target_url'=>$request->url()]);
                return $oauth->redirect();
                // 这里不一定是return，如果你的框架action不是返回内容的话你就得使用
                // $oauth->redirect()->send();
                exit;
            endif;
        endif;
        $user_login_status = Session::get('user_login_status');
        if(!$user_login_status){
            session(['target_url'=>$request->url()]);
            return redirect()->route('weixin.login');//没有登录状态，跳转到顶楼页面
            exit;
        }
        return $next($request);
    }
}
