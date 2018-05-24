<?php
/**
 * Created by PhpStorm.
 * User: cooper
 * Date: 2017/2/12
 * Time: 下午12:31
 */
if (!function_exists('oauth_check')) {
    /**
     * 记录账号
     */
    function oauth_check($type,$array){
        $model = new \App\Models\UserOauthModel();
        $openid = $array['id'];
        //通过openid查询数据是否存在，存在更新，不存在
        $infos = $model::where('open_id',$openid)->first();
        if($infos)://存在更新
            $infos->id = $infos['id'];
            $infos->open_id = $openid;
            $infos->name = $array['name'];
            $infos->nick_name = $array['nickname'];
            $infos->avatar = $array['avatar'];
            $infos->email = $array['email'];
            $infos->sex = $array['original']['sex'];
            $infos->access_token = $array['token']['access_token'];
            $infos->expires_in = $array['token']['expires_in'];
            $infos->refresh_token = $array['token']['refresh_token'];
            $infos->content = json_encode($array);
            $infos->save();
        else://不存在新增
            $infos_input['open_id'] = $openid;
            $infos_input['type'] = $type;
            $infos_input['name'] = $array['name'];
            $infos_input['nick_name'] = $array['nickname'];
            $infos_input['avatar'] = $array['avatar'];
            $infos_input['email'] = $array['email'];
            $infos_input['sex']= $array['original']['sex'];
            $infos_input['access_token'] = $array['token']['access_token'];
            $infos_input['expires_in'] = $array['token']['expires_in'];
            $infos_input['refresh_token'] = $array['token']['refresh_token'];
            $infos_input['content'] = json_encode($array);
            $model::create($infos_input);
        endif;
    }
    if (!function_exists('oauth_bind')) {
        /**
         * 绑定账号
         */
        function oauth_bind($open_id, $user_id)
        {
            $model = new \App\Models\UserOauthModel();
            $infos = $model::where('open_id',$open_id)->first();
            $infos->id = $infos['id'];
            $infos->user_id = $user_id;
            $infos->save();
        }
    }
    if (!function_exists('get_oauth_user_id_by_open_id')) {
        /**
         * 通过open_id获取对应的user_id
         */
        function get_oauth_user_id_by_open_id($open_id)
        {
            $model = new \App\Models\UserOauthModel();
            //通过openid查询数据是否存在，存在更新，不存在
            $infos = $model::where('open_id',$open_id)->first();
            return $infos;
        }
    }

}

