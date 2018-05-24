<?php
use EasyWeChat\Foundation\Application;
use EasyWeChat\Payment\Order;

/**
 * Created by PhpStorm.
 * User: cooper
 * Date: 2017/3/17
 * Time: 下午12:31
 */
if (!function_exists('create_order')) {
    /**
     * create_order
     * $type 商事证明书等
     * $order_number订单编号
     */
    function create_order($order_number,$trade_type)
    {
        $infos_order = get_order_info_by_order_number($order_number);
        //创建订单
        $attributes = [
            'trade_type' => $trade_type, // JSAPI微信公众账号内，NATIVE扫码，APP...
            'body' => '订单号：'.$order_number,
            'detail' => '',
            'out_trade_no' => $order_number,//商户订单编号
            'total_fee' => $infos_order['total'] * 100, // 单位：分
            'notify_url' => route('weixin.notify_wxpay'), // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'openid' => get_openid_by_user_id(), // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...'omSIQw-i8UDbIJz4-Sf11_qf5DmQ'
        ];
        $order = new Order($attributes);
        return $order;
    }
}
if (!function_exists('unifiedorder')) {
    /**
     * unifiedorder
     * 统一下单
     * @todo创建成功后，应该写入数据表prepay_id，创建时间信息
     */
    function unifiedorder($order_number, $order)
    {
        $options = get_wechat_options();
        $app = new Application($options);
        $payment = $app->payment;
        $result = $payment->prepare($order);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
            put_remark_pay_by_order_number($order_number, $result);//写入预标识信息
            $response = array(
                'status' => 's',
                'code' => 1000,
                'msg' => '创建订单成功',
                'data' => array(
                    'prepay_id' => $result->prepay_id,
                    'code_url' => $result->code_url,
                )
            );
        } elseif ($result->return_code == 'SUCCESS' && $result->result_code == 'FAIL') {
            $response = array(
                'status' => 'f',
                'code' => 4001,
                'msg' => $result->err_code_des
            );
        } else {
            $response = array(
                'status' => 'f',
                'code' => 4000,
                'msg' => $result->err_code_des
            );
        }
        return $response;
    }
}

if (!function_exists('get_query_order_by_out_trade_no')) {
    /**
     * get_query_by_out_trade_no
     * 通过商户订单编号查询微信订单
     * $type 商事证明书
     * $order_number订单编号
     */
    function get_query_order_by_out_trade_no($order_number)
    {
        $options = get_wechat_options();
        $app = new Application($options);
        $payment = $app->payment;
        $order_query = $payment->query($order_number);
        $result = object_to_array($order_query);
        if ($order_query['return_code'] == 'SUCCESS') {
            if ($order_query['result_code'] == 'SUCCESS') {//查询订单回复
                if ($order_query['trade_state'] == 'SUCCESS') {//支付成功
                    $response = array(
                        'status' => 's',
                        'code' => 1000,
                        'msg' => '',
                        'result' => $result
                    );
                } elseif ($order_query['trade_state'] == 'REFUND') {//转入退款
                    $response = array(
                        'status' => 's',
                        'code' => 1000,
                        'msg' => '',
                        'result' => $result
                    );
                } elseif ($order_query['trade_state'] == 'NOTPAY') {//订单未支付
                    $response = array(
                        'status' => 'f',
                        'code' => 4000,
                        'msg' => $order_query['trade_state_desc'],
                        'result' => $result
                    );
                } elseif ($order_query['trade_state'] == 'CLOSED') {//已关闭
                    $response = array(
                        'status' => 'f',
                        'code' => 4001,
                        'msg' => '',
                        'result' => $result
                    );
                } elseif ($order_query['trade_state'] == 'REVOKED') {//已撤销（刷卡支付）
                    $response = array(
                        'status' => 's',
                        'code' => 1000,
                        'msg' => '',
                        'result' => $result
                    );
                } elseif ($order_query['trade_state'] == 'USERPAYING') {//用户支付中
                    $response = array(
                        'status' => 's',
                        'code' => 1000,
                        'msg' => '',
                        'result' => $result
                    );
                } elseif ($order_query['trade_state'] == 'PAYERROR') {//支付失败(其他原因，如银行返回失败)
                    $response = array(
                        'status' => 's',
                        'code' => 1000,
                        'msg' => '',
                        'result' => $result
                    );
                }
            } elseif ($order_query['result_code'] == 'FAIL') {//订单不存在
                if ($order_query['err_code'] == 'ORDERNOTEXIST') {//订单不存在
                    $response = array(
                        'status' => 'f',
                        'code' => 4010,
                        'msg' => $order_query['err_code_des'],
                        'result' => $result
                    );
                }
            }
        } else {
            $response = array(
                'status' => 'f',
                'code' => 4011,
                'msg' => $order_query['return_msg'],
                'result' => $result
            );
        }
        return $response;

    }
}
if (!function_exists('get_config_jssdk_payment')) {
    /**
     * get_config_jssdk_payment
     * 通过jssdk方式发起支付
     */
    function get_config_jssdk_payment($prepayId)
    {
        $options = get_wechat_options();
        $app = new Application($options);
        $payment = $app->payment;
        $infos = $payment->configForJSSDKPayment($prepayId);
        return $infos;
    }
}

