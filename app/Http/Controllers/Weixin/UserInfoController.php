<?php

namespace App\Http\Controllers\Weixin;

use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class UserInfoController extends BaseController
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
    public function edit()
    {
        $id = Session::get('user_id');
        $infos = UserModel::find((int)$id);
        $infos['id'] = (int)$id;

        return view( $this->_skin .'.user.user_info.edit',compact('infos'));
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
        //会员表名称判断
        $signature = trim($request->get('signature'));
        $avatar = trim($request->get('avatar'));
        $sex = trim($request->get('sex'));
        $id = Session::get('user_id');
        $infos_input = UserModel::findOrFail((int)$id);
        $infos_input->signature = $signature;
        $infos_input->avatar = $avatar;
        $infos_input->sex = $sex;
        $infos_input->save();

        $infos['status'] = 's';
        $infos['code'] = '1000';
        $infos['msg'] = '修改成功！';
        $infos['url'] = route('u_weixin_account');//注册成功后跳转页面

        return response()->json($infos);
    }
}
