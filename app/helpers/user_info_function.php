<?php
/**
 * Created by PhpStorm.
 * User: cooper
 * Date: 2016/12/10
 * Time: 上午6:05
 */

if (!function_exists('get_user_info')) {
    /**
     * 获取用户信息
     * @param $user_id 通过用户id
     */
    function get_user_info($user_id)
    {
        $infos = \App\Models\UserModel::find($user_id);
        $infos = object_to_array($infos);
        return $infos;
    }
}
if (!function_exists('get_user_info_by_invite')) {

    /**
     * 获取用户信息
     * @param $invite_code 通过用户的邀请码
     */
    function get_user_info_by_invite($invite_code)
    {
        $infos = \App\Models\UserModel::where('invite_code',$invite_code)
            ->first();
        if($infos):
            return $infos;
        else:
            return false;
        endif;
    }
}
if (!function_exists('send_system_message')) {

    /**
     * 系统通知
     * @param $array [id,user_id,action,content,ip]
     */
    function send_system_message($array)
    {
        $array['action'] = $array['action'];
        $array['content'] = $array['content'];
        $array['user_id'] = $array['user_id'];
        $model = new \App\Models\SystemMessageModel();
        $array['ip'] = get_client_ip();
        $model::create($array);
    }
}

if (!function_exists('get_user_count')) {
    /**
     * 获取会员总数
     */
    function get_user_count()
    {
        $model = new \App\Models\UserModel();
        $infos = $model::count();
        return $infos;
    }
}
if (!function_exists('get_company_list')) {
    /**
     * 获取单位列表
     */
    function get_company_list()
    {
        $model = new \App\Models\CompanyModel();
        $infos = $model::get();
        return $infos;
    }
}
if (!function_exists('get_company_info')) {
    /**
     * 获取单位对应数据信息
     */
    function get_company_info($com_id)
    {
        $model = new \App\Models\CompanyModel();
        $infos = $model::where('id',$com_id)->first();
        $infos = object_to_array($infos);
        return $infos;
    }
}
if (!function_exists('get_user_list_all')) {
    /**
     * 获取会员列表
     */
    function get_user_list_all()
    {
        $model = new \App\Models\UserModel();
        $infos = $model::select(['id','name','phone','com_id','office_id','sex'])->get();
        $infos = object_to_array($infos);
        return $infos;
    }
}
if (!function_exists('get_user_list_by_user_id_in_array')) {
    /**
     * 获取会员列表通过数组
     */
    function get_user_list_by_user_id_in_array($array)
    {
        $model = new \App\Models\UserModel();
        $infos = $model::whereIn('id',$array)->select(['id','name','phone','com_id','office_id','sex'])->get();
        $infos = object_to_array($infos);
        return $infos;
    }
}
if (!function_exists('get_user_list_by_user_id_not_in_array')) {
    /**
     * 获取会员列表通过数组
     */
    function get_user_list_by_user_id_not_in_array($array)
    {
        $model = new \App\Models\UserModel();
        $infos = $model::whereNotIn('id',$array)->select(['id','name','phone','com_id','office_id','sex'])->get();
        $infos = object_to_array($infos);
        return $infos;
    }
}