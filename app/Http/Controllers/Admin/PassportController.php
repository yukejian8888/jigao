<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class PassportController extends Controller
{
    //
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/qyadmin';
    protected $username;
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function login(Request $request)
    {
        /**
         * 功能点 通过name查询，判断密码是否正确
         * 通过用户组标识符获取用户组id
         * 通过用户id、group_id获取user_group数据信息
         * 判断user_group是否有登录的权限
         */
        $input = Input::all();
        $account = $input['username'];
        $password = $input['password'];
        $infos = check_login($account,$password);
        if($infos['status']=='s'):
            $model = new \App\Models\UserRoleModel();
            $user_role = $model::where('user_id',$infos['data']['id'])->pluck('role_id');
            Session::put('user_login_status',true);
            Session::put('user_id',$infos['data']['id']);
            Session::put('user_name',$infos['data']['name']);
            Session::put('user_role',$user_role);
            $targetUrl = session()->has('target_url')?session('target_url'):route('admin.index');
            return redirect($targetUrl);
        else:
            return redirect()
                ->route('passport.login')
                ->with([
                    'flash_message' => $infos['msg']
                ]);
        endif;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(Request $request)
    {
        return view('admin.login.login');
    }
    /**
     * Show the application's logout.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Session::forget(['user_login_status','user_mark','user_name','user_id']);
        return redirect()->route('passport.login');
    }

}
