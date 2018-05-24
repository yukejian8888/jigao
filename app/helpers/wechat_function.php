<?php
use EasyWeChat\Foundation\Application;
/**
 * Created by PhpStorm.
 * User: cooper
 * Date: 2017/2/12
 * Time: 下午12:31
 */
if (!function_exists('get_wechat_settings')) {
    /**
     *
     */
    function get_wechat_settings(){//$user_id后期多微信系统增加$user_id

    }
}
if (!function_exists('is_weixin')) {
    /**
     * 判断是否是微信浏览器访问
     */
    function is_weixin(){
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),strtolower('MicroMessenger'))!==false) {
            return true;
        }
        return false;
    }
}
if (!function_exists('get_access_token')) {
    /*
         * getAccessToken
         * 获取access_token
         * @return json string
         *
         */

    function get_access_token($appid, $secret)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential';
        $url = $url . '&appid=' . $appid . '&secret=' . $secret;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 获取数据返回
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true); // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
        $output = curl_exec($ch);
        $out = json_decode($output);
        return $out->access_token; // 返回值access_token
    }
}
if (!function_exists('get_local_wechat_menu')) {//获取本地菜单信息，组装数据

    function get_local_wechat_menu(){
        $model = new \App\ModelsWechat\WechatMenuModel();
        $infos_button = $model::where('pid',0)->where('status','20')->get()->toArray();
        $button = array();
        foreach ($infos_button as $k=>$v):
            $button[$k]['name'] = $v['name'];
            $infos_sub_button = $model::where('pid',$v['id'])->where('status','20')->get()->toArray();
            if($infos_sub_button):
                foreach ($infos_sub_button as $m=>$n):
//                    $button[$k]['sub_button'][$m]['name'] = $n['name'];
                    $sub_button[$m]['name'] = $n['name'];
                    if($n['type']=='click'):
                        $sub_button[$m]['type'] = $n['type'];
                        $sub_button[$m]['key'] = $n['key'];
                    elseif($n['type']=='view'):
                        $sub_button[$m]['url'] = $n['url'];
                        $sub_button[$m]['type'] = $n['type'];
                    endif;
                    $button[$k]['sub_button'] = $sub_button;
                endforeach;
            else:
                if($v['type']=='click'):
                    $button[$k]['type'] = $v['type'];
                    $button[$k]['key'] = $v['key'];
                elseif($v['type']=='view'):
                    $button[$k]['type'] = $v['type'];
                    $button[$k]['url'] = $v['url'];
                endif;
            endif;
        endforeach;
    }
}
if (!function_exists('wechat_menu_create')) {
    /*
     * wechat_menu_create
     * 创建微信自定义菜单
     * @param string $access_token access_token
     * @param string $json 菜单信息
     * @return json string errcode
     *
     */

    function wechat_menu_create()
    {
        $model = new \App\ModelsWechat\WechatMenuModel();
        $infos_button = $model::where('pid',0)->where('status','20')->get()->toArray();
        $button = array();
        foreach ($infos_button as $k=>$v):
            $button[$k]['name'] = $v['name'];
            $infos_sub_button = $model::where('pid',$v['id'])->where('status','20')->get()->toArray();
            if($infos_sub_button):
                foreach ($infos_sub_button as $m=>$n):
                    $sub_button[$m]['name'] = $n['name'];
                    if($n['type']=='click'):
                        $sub_button[$m]['type'] = $n['type'];
                        $sub_button[$m]['key'] = $n['key'];
                    elseif($n['type']=='view'):
                        $sub_button[$m]['url'] = $n['url'];
                        $sub_button[$m]['type'] = $n['type'];
                    endif;
                    $button[$k]['sub_button'] = $sub_button;
                endforeach;
            else:
                if($v['type']=='click'):
                    $button[$k]['type'] = $v['type'];
                    $button[$k]['key'] = $v['key'];
                elseif($v['type']=='view'):
                    $button[$k]['type'] = $v['type'];
                    $button[$k]['url'] = $v['url'];
                endif;
            endif;
        endforeach;
        $options = get_wechat_options();
        $app = new Application($options);
        $menu = $app->menu;
        $rs = $menu->add($button);
        if($rs['errcode']=='0'){
            $array = array('status'=>'s','code'=>1000,'msg'=>'自定义菜单创建成功！');
        }else{
            $array = array('status'=>'f','code'=>4000,'msg'=>'自定义菜单创建失败！');
        }
        return $array;
    }
}
if (!function_exists('wechat_menu_list')) {
    /*
     * wechat_menu_delete
     * 查看所有微信自定义菜单
     * @return json string
     *
     */

    function wechat_menu_list()
    {
        $options = get_wechat_options();
        $app = new Application($options);
        $menu = $app->menu;
        $rs = $menu->all();
        dump($rs);
        if($rs['errcode']=='0'){
            $array = array('status'=>'s','code'=>1000,'msg'=>'自定义菜单删除成功！');
        }else{
            $array = array('status'=>'f','code'=>4000,'msg'=>'自定义菜单删除失败！');
        }
        return $array;
    }
}

if (!function_exists('wechat_menu_delete')) {
    /*
     * wechat_menu_delete
     * 删除微信自定义菜单
     * @return json string
     *
     */

    function wechat_menu_delete()
    {
        $options = get_wechat_options();
        $app = new Application($options);
        $menu = $app->menu;
        $rs = $menu->destroy();
        if($rs['errcode']=='0'){
            $array = array('status'=>'s','code'=>1000,'msg'=>'自定义菜单删除成功！');
        }else{
            $array = array('status'=>'f','code'=>4000,'msg'=>'自定义菜单删除失败！');
        }
        return $array;
    }
}

if (!function_exists('get_wechat_options')) {
    /*
     * get_wechat_options
     * 获取微信配置参数
     * @return json string
     *
     */

    function get_wechat_options()
    {
        $infos = \App\ModelsWechat\WechatSettingsModel::first();//封装查询方法，支付配置也封装查询方法
        $options['app_id'] = $infos->app_id;
        $options['secret'] = $infos->secret;
        $options['token'] = $infos->token;
        $options['aes_key'] = $infos->aes_key;
        $config = Config::get('weixin');
        $options['debug'] = $config['debug'];
        $options['log'] = array(
            'level'   => $config['log']['level'],
            'permission' => $config['log']['permission'],
            'file' => $config['log']['file'],
        );
        $options['oauth'] = array(
            'scopes'   => $config['oauth']['scopes'],
            'callback' => $config['oauth']['callback']
        );
        //做支付时在增加支付配置信息
        $options['payment'] = array(
            'merchant_id'   => $config['payment']['merchant_id'],
            'key'   => $config['payment']['key'],
            'cert_path'   => $config['payment']['cert_path'],
            'key_path' => $config['payment']['key_path']
        );
        $options['guzzle'] = array(
            'timeout'   => $config['guzzle']['timeout']
        );
        return $options;
    }
}
if (!function_exists('get_wechat_payment_options')) {
    /*
     * get_wechat_payment_options
     * 获取微信支付配置参数
     * @return json string
     *
     */

    function get_wechat_payment_options()
    {

    }
}
if (!function_exists('get_wechat_menu_key')) {
    /**
     * 处理调用分类相关的数据
     * @access public
     * @param array $type_model 要获取的模型类
     * @return array
     */
    function get_wechat_menu_key()
    {
        $model = new \App\ModelsWechat\WechatMenuModel();
        $infos = $model::where('type', 'click')->get(['id', 'name', 'key']);
        $tree = array();
        foreach($infos as $k=>$v){
            $tree[$v['key']] = $v['name'];
        }
        return $tree;
    }
}
if (!function_exists('get_openid_by_user_id')) {
    /**
     * 通过会员id获取微信openid
     * @return array
     */
    function get_openid_by_user_id()
    {
        $user_id = session('user_id');
        $model = new \App\Models\UserOauthModel();
        $infos = $model::where('user_id', $user_id)->select('id','user_id', 'open_id')->first();
        return $infos->open_id;
    }
}
