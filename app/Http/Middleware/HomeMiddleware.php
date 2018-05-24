<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class HomeMiddleware
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
        $local = session('locale_lang');
        if($local){//当存在时，设定本地语言
            App::setLocale($local);
        }
        return $next($request);
    }
}
