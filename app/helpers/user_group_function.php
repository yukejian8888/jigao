<?php
/**
 * Created by PhpStorm.
 * User: cooper
 * Date: 2016/12/10
 * Time: 上午6:05
 */

if (!function_exists('check_login')) {
    /**
     * 检查登录
     * @param $account 账户
     * @param $password 密码
     */
    function check_login($account,$password)
    {
        $array = array();
        if(empty(trim($account))||empty(trim($password))):
            $array['status'] = 'f';
            $array['code'] = '4000';
            $array['msg'] = '请填写完整信息！';
            $array['data'] = '';
        else:
            $infos = \App\Models\UserModel::where('name',$account)->orwhere('phone',$account)->first();
            if($infos)://判断用户是否存在
                if(Hash::check($password,$infos->password))://匹配密码是否一致
                    //通过标识符获取用户组信息
//                    $infos_mark = check_user_group($infos);
                    $array['status'] = 's';
                    $array['code'] = '1000';
                    $array['msg'] = '账号校验成功';
                    $array['data'] = $infos;
                else:
                    $array['status'] = 'f';
                    $array['code'] = '4000';
                    $array['msg'] = '您输入的用户名或者密码不正确不正确！';
                    $array['data'] = '';
                endif;
            else:
                $array['status'] = 'f';
                $array['code'] = '4000';
                $array['msg'] = '您输入的账户、密码有误！';
                $array['data'] = '';
            endif;
        endif;
        return $array;
    }
}
if (!function_exists('get_user_mark_by_user_id')) {

    function get_user_mark_by_user_id($user_id)
    {
        $infos = \App\Models\UserGroupModel::join('manage_group','manage_group.id','=','user_group.group_id')
            ->where('user_group.user_id',$user_id)
            ->where('user_group.status',20)//开启启用状态
            ->where('user_group.status_auth',20)//开启授权状态
            ->get(['manage_group.mark']);
        if($infos):
            $info_mark = array();
            foreach ($infos as $k=>$v):
                $info_mark[] = $v['mark'];
            endforeach;
            return $info_mark;
        else:
            return false;
        endif;
    }
}
if (!function_exists('check_user_group')) {
    /**
     * 通过会员id，分组id获取 用户分组权限
     * @param $user_id
     * @return bool
     */
    function check_user_group($infos)
    {
        $infos_user_group = get_user_group_info_by_userid($infos['id']);
        if($infos_user_group)://获取用户权限分配
            //判断启用、禁用状态
            if($infos_user_group->status_auth=='10'):
                $array['status'] = 'f';
                $array['code'] = '4000';
                $array['msg'] = '您没有登录访问权限！';
                $array['data'] = '';
            elseif ($infos_user_group->status_auth=='20'):
                $array['status'] = 's';
                $array['code'] = '1000';
                $array['msg'] = '登录成功';
                $array['data'] = $infos;
            endif;
        else:
            $array['status'] = 'f';
            $array['code'] = '4000';
            $array['msg'] = '您没有登录访问权限！';
            $array['data'] = '';
        endif;
        return $array;
    }
}
if (!function_exists('get_user_group_info_by_userid')) {
    /**
     * 通过会员id，分组id获取 用户分组权限
     * @param $user_id
     * @param $group_id
     * @return bool
     */
    function get_user_group_info_by_userid($user_id)
    {
        if(empty($user_id)):
            return false;
        endif;
        $infos = \App\Models\UserGroupModel::where('user_id',$user_id)->first();
        if($infos):
            return $infos;
        else:
            return false;
        endif;
    }
}

if (!function_exists('get_manage_group_radio_list')) {
    /**
     * 通过会员id，分组id获取 用户分组权限
     * @param $user_id
     * @param $group_id
     * @return bool
     */
    function get_manage_group_radio_list()
    {
        $model = new \App\Models\ManageGroupModel();
        $infos = $model::orderBy('id','asc')->get(['id', 'name']);
        foreach($infos as $k=>$v){
            $tree[$v['id']] = $v['name'];
        }
        return $tree;
    }
}

if (!function_exists('get_manage_group_info_user_id')) {
    /**
     * 通过会员id，获取mark
     * @param $user_id
     * @param $group_id
     * @return bool
     */
    function get_manage_group_info_user_id($user_id)
    {
        $infos_user_group = get_user_group_info_by_userid($user_id);
        if($infos_user_group):
            $model = new \App\Models\ManageGroupModel();
            $infos_manage_mark = $model::where('id',$infos_user_group['group_id'])->first();
            return $infos_manage_mark;
        else:
            return false;
        endif;
        $model = new \App\Models\ManageGroupModel();
        $infos = $model::orderBy('id','asc')->get(['id', 'name']);
        foreach($infos as $k=>$v){
            $tree[$v['id']] = $v['name'];
        }
        return $tree;
    }
}