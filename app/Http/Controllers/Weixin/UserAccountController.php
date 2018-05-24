<?php

namespace App\Http\Controllers\Weixin;

use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class UserAccountController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infos = '';
        return view( $this->_skin .'.user.user_account.account_list',compact('infos'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_name()
    {
        $id = Session::get('user_id');
        $infos = UserModel::find((int)$id);
        $infos['id'] = (int)$id;
        return view( $this->_skin .'.user.user_account.edit_name',compact('infos'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update_name(Request $request)
    {
        $id = Session::get('user_id');
        //会员表名称判断
        $name = trim($request->get('name'));
        if(empty($name)):
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '用户名不能为空！';
        else:
            $infos_ui = UserModel::where('name',$name)->where('id','<>',$id)->first();
            if($infos_ui):
                $infos['status'] = 'f';
                $infos['code'] = '4000';
                $infos['msg'] = '用户名已经存在，请使用其他用户名！';
            else:
                $infos_save = UserModel::findOrFail((int)$id);
                $infos_save->name = $name;
                $infos_save->save();
                Session::put('user_name',$name);
                $infos['status'] = 's';
                $infos['code'] = '1000';
                $infos['msg'] = '用户名更改成功！';
                $infos['url'] = route('u_weixin_account');//注册成功后跳转页面
            endif;
        endif;
        return response()->json($infos);
    }
    public function edit_phone()
    {
        $id = Session::get('user_id');
        $infos = UserModel::find((int)$id);
        $infos['id'] = (int)$id;
        return view( $this->_skin .'.user.user_account.edit_phone',compact('infos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update_phone(Request $request)
    {
        $phone = $request->get('phone');
        $sms_code = $request->get('sms_code');
        $infos = array();
        $rs_phone = check_phone($phone);
        if(!$rs_phone){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '手机号码格式不正确！';
            return response()->json($infos);
        }
        $id = Session::get('user_id');
        //判断手机号码是否修改
        $user_infos = get_user_info($id);
        if($user_infos['phone']==$phone){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '手机号码未变更！';
            return response()->json($infos);
        }
        //判断手机号码是否已经存在
        $infos_phone = UserModel::where('phone',$phone)->where('id','<>',$id)->first();
        if($infos_phone){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '手机号码已存在！';
            return response()->json($infos);
        }
        //验证手机号码与短信验证码
        $rs_check_code = check_sms_code($phone,$sms_code);
        if($rs_check_code['status']=='s'){
            //这里是要更新数据
            $infos_save = UserModel::findOrFail((int)$id);
            $infos_save->phone = $phone;
            $infos_save->save();

            $infos['status'] = 's';
            $infos['code'] = '1000';
            $infos['msg'] = '手机号码变更成功';
            $infos['url'] = route('u_weixin_account');//找回密码成功后跳转页面
            return response()->json($infos);
        }else{
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = $rs_check_code['msg'];
            return response()->json($infos);
        }
    }

    /**
     * 更换手机号码
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_sms_code(Request $request)
    {
        $phone = $request->get('phone');
        $infos = array();
        $rs_phone = check_phone($phone);
        if(!$rs_phone){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '手机号码格式不正确！';
            return response()->json($infos);
        }
        $id = Session::get('user_id');
        //判断手机号码是否修改
        $user_infos = get_user_info($id);
        if($user_infos['phone']==$phone){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '手机号码未变更！';
            return response()->json($infos);
        }
        //判断手机号码是否已经存在
        $infos_phone = UserModel::where('phone',$phone)->where('id','<>',$id)->first();
        if($infos_phone){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '手机号码已存在！';
            return response()->json($infos);
        }
        $rs_sms_code = send_sms_code_by_change_phone($phone);//更换手机号码发送验证码
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

    public function edit_email()
    {
        $id = Session::get('user_id');
        $infos = UserModel::find((int)$id);
        $infos['id'] = (int)$id;
        return view( $this->_skin .'.user.user_account.edit_email',compact('infos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update_email(Request $request)
    {
        $id = Session::get('user_id');
        //会员表名称判断
        $email = trim($request->get('email'));
        if(empty($email)):
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '邮箱不能为空！';
        else:
            $infos_ui = UserModel::where('email',$email)->where('id','<>',$id)->first();
            if($infos_ui):
                $infos['status'] = 'f';
                $infos['code'] = '4000';
                $infos['msg'] = '邮箱已经存在，请使用其他邮箱！';
            else:
                $infos_save = UserModel::findOrFail((int)$id);
                $infos_save->email = $email;
                $infos_save->save();
                $infos['status'] = 's';
                $infos['code'] = '1000';
                $infos['msg'] = '邮箱更改成功！';
                $infos['url'] = route('u_weixin_account');//注册成功后跳转页面
            endif;
        endif;
        return response()->json($infos);
    }
}
