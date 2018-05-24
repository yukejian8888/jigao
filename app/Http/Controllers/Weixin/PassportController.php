<?php

namespace App\Http\Controllers\Weixin;


use App\Http\Requests\Admin\UserCreateRequest;
use App\Models\UserInviteModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Events\UserRegisterEvent;

class PassportController extends BaseController
{
    //登录页面
    public function login(Request $request)
    {
        return view( $this->_skin .'.user.login');
    }
    //登录验证
    public function check_login(Request $request)
    {
        $input = Input::all();
        $account = $input['username'];
        $password = $input['password'];
        $infos = check_login($account,$password);
        if($infos['status']=='s'):
            $check_user_group = check_user_group($infos['data']);
            if($check_user_group['status']=='s'):
                $user_id = $infos['data']['id'];
                //执行绑定操作
                if(session()->has('wechat_user')):
                    $weixin_array = session('wechat_user');
                    $open_id = $weixin_array['id'];
                    oauth_bind($open_id,$user_id);
                endif;
                Session::put('user_login_status',true);
                Session::put('user_id',$user_id);
                Session::put('user_name',$infos['data']['name']);
                $targetUrl = session()->has('target_url')?session('target_url'):route('weixin.index');
                $infos['url'] = $targetUrl;//登录后跳转页面
                return response()->json($infos);
            else:
                $infos['status']='f';
                $infos['msg']='禁止登陆';
                return response()->json($infos);
            endif;
        else:
            return response()->json($infos);
        endif;
    }


    public function register(Request $request)
    {
        //访问时判断code是否有值，有值获取，没有值，查下cookie。
        //但在提交时还是要根据表单里面的值来觉得邀请人
        if ($request->has('code')):
            Session::put('invite_code',$request->code);
        endif;
        return view( $this->_skin .'.user.register');
    }

    //获取验证码,注册验证码
    public function get_sms_code()
    {
        $input = Input::all();
        $phone = $input['phone'];
        $infos = array();
        $rs_phone = check_phone($phone);
        if(!$rs_phone){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '手机号码格式不正确！';
            return response()->json($infos);
        }
        //判断手机号码是否已经存在
        $rs_phone_unique = check_phone_unique($phone);
        if($rs_phone_unique['status']=='f'){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = $rs_phone_unique['msg'];
            return response()->json($infos);
        }
        $rs_sms_code = send_sms_code_by_reg($phone);//注册发送验证码

        if($rs_sms_code['status']=='s'){
            $infos['status'] = 's';
            $infos['code'] = '1000';
            $infos['msg'] = '验证码已经发送！';
            return response()->json($infos);
        }else{
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = $rs_sms_code['msg'];
            return response()->json($infos);
        }
    }

    //注册功能
    public function check_register(Request $request)
    {
        $input = Input::all();
        $phone = $input['phone'];
        $sms_code = trim($input['sms_code']);
        $password = trim($input['password']);
        $pwd2 = trim($input['pwd2']);
        $infos = array();
        $rs_phone = check_phone($phone);
        if(!$rs_phone){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '手机号码格式不正确！';
            return response()->json($infos);
        }
        if(empty($sms_code)){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '手机短信验证码不能为空！';
            return response()->json($infos);
        }
        if(empty($password)||empty($pwd2)){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '密码不能为空！';
            return response()->json($infos);
        }
        if(strlen($password)<6){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '密码请输入6位（包含6位）以上字母或者数字！';
            return response()->json($infos);
        }
        if($password!=$pwd2){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '两次密码填写不一样！';
            return response()->json($infos);
        }
        //验证手机号码与短信验证码
        $rs_check_code = check_sms_code($phone,$sms_code);
        if($rs_check_code['status']=='s'){
            //判断手机号码是否已经存在
            $rs_phone_unique = check_phone_unique($phone);
            if($rs_phone_unique['status']=='s'){
                $input_user['phone'] = $phone;
                $input_user['password'] = Hash::make($password);
                $result = UserModel::create($input_user);
                $result['mark'] = 'member_personal';//启用分组事件，必须设置mark标识符，值可以为空
                event(new UserRegisterEvent($result));//注册时事件及事件监听器
                $infos['status'] = 's';
                $infos['code'] = '1000';
                $infos['msg'] = '注册成功';
                $infos['url'] = route('weixin.login');//注册成功后跳转页面
                return response()->json($infos);
            }else{
                $infos['status'] = 'f';
                $infos['code'] = '4000';
                $infos['msg'] = $rs_phone_unique['msg'];
                return response()->json($infos);
            }
        }else{
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = $rs_check_code['msg'];
            return response()->json($infos);
        }

    }

    public function forget()
    {
        return view( $this->_skin .'.user.forget');
    }
    //获取找回密码验证码
    public function get_forget_sms_code()
    {
        $input = Input::all();
        $phone = $input['phone'];
        $infos = array();
        $rs_phone = check_phone($phone);
        if(!$rs_phone){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '手机号码格式不正确！';
            return response()->json($infos);
        }
        //判断手机号码是否已经存在
        $rs_phone_unique = check_phone_unique($phone);
        if($rs_phone_unique['status']=='s'){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = $rs_phone_unique['msg'];
            return response()->json($infos);
        }
        $rs_sms_code = send_sms_code_by_forget($phone);//找回密码发送验证码
        if($rs_sms_code['status']=='s'){
            $infos['status'] = 's';
            $infos['code'] = '1000';
            $infos['msg'] = '验证码已经发送！';
            return response()->json($infos);
        }else{
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = $rs_sms_code['msg'];
            return response()->json($infos);
        }
    }
    //校验找回密码功能
    public function check_forget(Request $request)
    {
        $input = Input::all();
        $phone = $input['phone'];
        $sms_code = trim($input['sms_code']);
        $password = trim($input['password']);
        $pwd2 = trim($input['pwd2']);
        $infos = array();
        $rs_phone = check_phone($phone);
        if(!$rs_phone){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '手机号码格式不正确！';
            return response()->json($infos);
        }
        if(empty($sms_code)){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '手机短信验证码不能为空！';
            return response()->json($infos);
        }
        if(empty($password)||empty($pwd2)){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '密码不能为空！';
            return response()->json($infos);
        }

        if(strlen($password)<6){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '密码请输入6位（包含6位）以上字母或者数字！';
            return response()->json($infos);
        }
        if($password!=$pwd2){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '两次密码填写不一样！';
            return response()->json($infos);
        }
        //判断手机号码是否已经存在,不存在
        $rs_phone_unique = check_phone_unique($phone);
        if($rs_phone_unique['status']=='s'){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = $rs_phone_unique['msg'];
            return response()->json($infos);
        }
        //验证手机号码与短信验证码
        $rs_check_code = check_sms_code($phone,$sms_code);
        if($rs_check_code['status']=='s'){
            //这里是要更新数据
            $model = new UserModel();
            $user_input = $model::where('phone',$phone)->first();
            $user_input['password'] = Hash::make($password);
            $user_input->save();
//                $result = UserModel::create($input_user);
            $infos['status'] = 's';
            $infos['code'] = '1000';
            $infos['msg'] = '找回密码成功';
            $infos['url'] = route('weixin.login');//找回密码成功后跳转页面
            return response()->json($infos);
        }else{
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = $rs_check_code['msg'];
            return response()->json($infos);
        }

    }
    /**
     * Show the application's logout.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Session::forget(['user_login_status','user_mark','user_name','user_id']);
        return redirect()->route('weixin.index');
    }
}
