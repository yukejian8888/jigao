<?php

namespace App\Http\Controllers\Weixin;

use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserPasswordController extends BaseController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $infos = '';
        return view( $this->_skin .'.user.user_password.edit',compact('infos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = Session::get('user_id');
        $old_pwd = trim($request->get('old_pwd'));
        $pwd1 = trim($request->get('pwd1'));
        $pwd2 = trim($request->get('pwd2'));
        if(empty($old_pwd)||empty($pwd1)||empty($pwd2)):
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '请将密码项输入完整！';
        endif;
        if(strlen($pwd1)<6){
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '密码请输入6位（包含6位）以上字母或者数字！';
            return response()->json($infos);
        }
        if($pwd1!=$pwd2):
            $infos['status'] = 'f';
            $infos['code'] = '4000';
            $infos['msg'] = '新密码两次输入不一致！';
        endif;
        if(!empty($old_pwd)&&!empty($pwd1)&&!empty($pwd2)):
            $infos_input = UserModel::findOrFail((int)$id);
            if(Hash::check($old_pwd,$infos_input->password))://匹配密码是否一致
                $infos_input->password = Hash::make($pwd1);
                $infos_input->save();
                $infos['status'] = 's';
                $infos['code'] = '1000';
                $infos['msg'] = '密码更改成功！';
                $infos['url'] = route('u_weixin_account');//注册成功后跳转页面
            else:
                $infos['status'] = 'f';
                $infos['code'] = '4000';
                $infos['msg'] = '原密码输入不正确！';
            endif;
        endif;

        return response()->json($infos);
    }
}
