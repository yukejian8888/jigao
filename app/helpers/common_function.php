<?php
/**
 * Created by PhpStorm.
 * User: cooper
 * Date: 2016/12/10
 * Time: 上午6:05
 */

if (!function_exists('array_to_tree')) {
    /**
     * 把返回的数据集转换成Tree
     * @access public
     * @param array $list 要转换的数据集
     * @param string $pid parent标记字段
     * @param string $level level标记字段
     * @return array
     * //$tree = array_merge(array(array('id' => 0, 'text' => '全部文档')), $tree);
     */
    function array_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0)
    {
        // 创建Tree
        $tree = array();
        if (is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] = & $list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId = $data[$pid];
                if ($root == $parentId) {
                    $tree[] = & $list[$key];
                } else {
                    if (isset($refer[$parentId])) {
                        $parent = & $refer[$parentId];
                        $parent[$child][] = & $list[$key];
                    }
                }
            }
        }
        return $tree;
    }
}
if (!function_exists('object_to_array')) {
    /*
     * obj转数组
     * $obj
     */
    function object_to_array($obj)
    {
        return json_decode(json_encode($obj),true);
    }
}
/**
 * Get client ip.
 *
 * @return string
 */
function get_client_ip()
{
    if (!empty($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    } else {
        // for php-cli(phpunit etc.)
        $ip = gethostbyname(gethostname());
    }

    return filter_var($ip, FILTER_VALIDATE_IP) ?: '127.0.0.1';
}

if (!function_exists('get_uuid')) {
    /*
     * getUuid
     * 生成uuid
     * @do R('Common/System/getUuid');
     */
    function get_uuid()
    {
        mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $uuid = substr($charid, 0, 8)
            . substr($charid, 8, 4)
            . substr($charid, 12, 4)
            . substr($charid, 16, 4)
            . substr($charid, 20, 12);
        return $uuid;
    }
}
if (!function_exists('check_pic_empty')) {
    /*
     * 检查图片是否为空，为空时输出默认图片
     *
     */
    function check_pic_empty($pic_url)
    {
        if(!empty($pic_url)){
            return Html::image($pic_url);
        }else{
            return Html::image('default.jpg');
        }
    }
}
if (!function_exists('get_server_info')) {
    /*
     * 获取服务器信息
     */
    function get_server_info()
    {
        $infos = array(
            '操作系统'=>PHP_OS,
            '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
            '主机名'=>$_SERVER['SERVER_NAME'],
            'WEB服务端口'=>$_SERVER['SERVER_PORT'],
            '网站文档目录'=>$_SERVER["DOCUMENT_ROOT"],
            '浏览器信息'=>substr($_SERVER['HTTP_USER_AGENT'], 0, 40),
            '通信协议'=>$_SERVER['SERVER_PROTOCOL'],
            '请求方法'=>$_SERVER['REQUEST_METHOD'],
            '上传附件限制'=>ini_get('upload_max_filesize'),
            '执行时间限制'=>ini_get('max_execution_time').'秒',
            '服务器时间'=>date("Y年n月j日 H:i:s"),
            '北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
            '服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
            '用户的IP地址'=>$_SERVER['REMOTE_ADDR'],
            '剩余空间'=>round((disk_free_space(".")/(1024*1024)),2).'M',
        );
        return $infos;
    }
}