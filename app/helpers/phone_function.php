<?php
/**
 * Created by PhpStorm.
 * User: cooper
 * Date: 2016/12/10
 * Time: 上午6:05
 */

if (!function_exists('send_sms_code')) {
    /**
     * 获取用户信息
     * @param $user_id 通过用户id
     */
    function send_sms_code($sms_array)
    {
//        return false;
        // 接收人手机号
//        $to = '';
        $to = $sms_array['phone'];
// 短信模版
        $templates = [
            'Alidayu' => $sms_array['temp_id'],
//            'YunTongXun' => 'your_temp_id',
//            'SubMail'    => 'your_temp_id'
        ];
// 模版数据
        $tempData = [
            'code' => $sms_array['code'],
            'product' => ''
        ];
// 短信内容
        $content = '【签名】这是短信内容...';

// 只希望使用模板方式发送短信,可以不设置content(如:云通讯、Submail、Ucpaas)
        $rs = PhpSms::make()->to($to)->template($templates)->data($tempData)->send();
        log_sms($sms_array,$rs);//发送记录
//        dump($sms_array);
//        dump($rs);
        if($rs['success']){//true
            return true;
        }else{//false
            return false;
        }


// 只希望使用内容方式放送,可以不设置模板id和模板data(如:云片、luosimao)
//        PhpSms::make()->to($to)->content($content)->send();

// 同时确保能通过模板和内容方式发送,这样做的好处是,可以兼顾到各种类型服务商
//        PhpSms::make()->to($to)
//            ->template($templates)
//            ->data($tempData)
//            ->content($content)
//            ->send();
    }
}
//
if(!function_exists('send_sms_code_by_reg'))
{
    function send_sms_code_by_reg($phone)
    {
        $infos = \App\Models\SmsLogModel::orderBy('id','desc')
            ->where('phone',$phone)
            ->where('status_send',11)//发送成功
            ->where('type_send',10)//短信验证码10，短信通知11
            ->first();
        $sms_array = array();
        $sms_array['phone'] = $phone;
        $sms_array['type_send'] = 10;
        $sms_array['temp_id'] = 'SMS_11925090';
        $sms_array['code'] = rand(100000,999999);
        $array = array();
        if($infos){//存在，验证发送条件
            //判断上一次发送时间
            $finished_at = $infos['finished_at'];
            $now = time();
//            echo $now-$finished_at;
            if(($now-$finished_at)<60){
                $array['status'] = 'f';
                $array['code'] = 4000;
                $array['msg'] = '两次发送间隔不能小于60秒';
            }else{
                $rs_send = send_sms_code($sms_array);
                if($rs_send){
                    $array['status'] = 's';
                    $array['code'] = 1000;
                    $array['msg'] = '短信发送成功';
                }else{
                    $array['status'] = 'f';
                    $array['code'] = 4000;
                    $array['msg'] = '发送失败';
                }
            }
            return $array;
//            //判断最近一个小时内已经发送了几条短信
//            $count = 0;
//            if($count>=7){
//                $array['status'] = 'f';
//                $array['code'] = 4000;
//                $array['msg'] = '一小时内最多允许发送7条验证码';
//                return $array;
//            }

        }else{//不存在，直接发送验证码
            $rs_send = send_sms_code($sms_array);
            if($rs_send){
                $array['status'] = 's';
                $array['code'] = 1000;
                $array['msg'] = '短信发送成功';
            }else{
                $array['status'] = 'f';
                $array['code'] = 4000;
                $array['msg'] = '发送失败';
            }
            return $array;
        }
    }
}
//找回密码发送验证码
if(!function_exists('send_sms_code_by_forget'))
{
    function send_sms_code_by_forget($phone)
    {
        $infos = \App\Models\SmsLogModel::orderBy('id','desc')
            ->where('phone',$phone)
            ->where('status_send',11)//发送成功
            ->where('type_send',10)//短信验证码10，短信通知11
            ->first();
        $sms_array = array();
        $sms_array['phone'] = $phone;
        $sms_array['type_send'] = 10;
        $sms_array['temp_id'] = 'SMS_11925090';
        $sms_array['code'] = rand(100000,999999);
        $array = array();
        if($infos){//存在，验证发送条件
            //判断上一次发送时间
            $finished_at = $infos['finished_at'];
            $now = time();
//            echo $now-$finished_at;
            if(($now-$finished_at)<60){
                $array['status'] = 'f';
                $array['code'] = 4000;
                $array['msg'] = '两次发送间隔不能小于60秒';
            }else{
                $rs_send = send_sms_code($sms_array);
                if($rs_send){
                    $array['status'] = 's';
                    $array['code'] = 1000;
                    $array['msg'] = '短信发送成功';
                }else{
                    $array['status'] = 'f';
                    $array['code'] = 4000;
                    $array['msg'] = '发送失败';
                }
            }
            return $array;
//            //判断最近一个小时内已经发送了几条短信
//            $count = 0;
//            if($count>=7){
//                $array['status'] = 'f';
//                $array['code'] = 4000;
//                $array['msg'] = '一小时内最多允许发送7条验证码';
//                return $array;
//            }

        }else{//不存在，直接发送验证码
            $rs_send = send_sms_code($sms_array);
            if($rs_send){
                $array['status'] = 's';
                $array['code'] = 1000;
                $array['msg'] = '短信发送成功';
            }else{
                $array['status'] = 'f';
                $array['code'] = 4000;
                $array['msg'] = '发送失败';
            }
            return $array;
        }
    }
}

//找回密码发送验证码
if(!function_exists('send_sms_code_by_change_phone'))
{
    function send_sms_code_by_change_phone($phone)
    {
        $infos = \App\Models\SmsLogModel::orderBy('id','desc')
            ->where('phone',$phone)
            ->where('status_send',11)//发送成功
            ->where('type_send',10)//短信验证码10，短信通知11
            ->first();
        $sms_array = array();
        $sms_array['phone'] = $phone;
        $sms_array['type_send'] = 10;
        $sms_array['temp_id'] = 'SMS_11925090';
        $sms_array['code'] = rand(100000,999999);
        $array = array();
        if($infos){//存在，验证发送条件
            //判断上一次发送时间
            $finished_at = $infos['finished_at'];
            $now = time();
//            echo $now-$finished_at;
            if(($now-$finished_at)<60){
                $array['status'] = 'f';
                $array['code'] = 4000;
                $array['msg'] = '两次发送间隔不能小于60秒';
            }else{
                $rs_send = send_sms_code($sms_array);
                if($rs_send){
                    $array['status'] = 's';
                    $array['code'] = 1000;
                    $array['msg'] = '短信发送成功';
                }else{
                    $array['status'] = 'f';
                    $array['code'] = 4000;
                    $array['msg'] = '发送失败';
                }
            }
            return $array;
//            //判断最近一个小时内已经发送了几条短信
//            $count = 0;
//            if($count>=7){
//                $array['status'] = 'f';
//                $array['code'] = 4000;
//                $array['msg'] = '一小时内最多允许发送7条验证码';
//                return $array;
//            }

        }else{//不存在，直接发送验证码
            $rs_send = send_sms_code($sms_array);
            if($rs_send){
                $array['status'] = 's';
                $array['code'] = 1000;
                $array['msg'] = '短信发送成功';
            }else{
                $array['status'] = 'f';
                $array['code'] = 4000;
                $array['msg'] = '发送失败';
            }
            return $array;
        }
    }
}

//验证手机号码格式
if(!function_exists('check_phone'))
{
    function check_phone($mobile)
    {
        if (!is_numeric($mobile)) {
            return false;
        }
        return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
    }
}
//验证码手机号码与验证码
if(!function_exists('check_sms_code'))
{
    function check_sms_code($phone,$sms_code)
    {
        $model_sms_log = new \App\Models\SmsLogModel();
        $infos = $model_sms_log::orderBy('id','desc')
            ->where('phone',$phone)
            ->where('code',$sms_code)
            ->where('status_send',11)//发送成功
            ->where('type_send',10)//短信验证码10，短信通知11
            ->where('status_check',10)//10未验证，11已验证成功，12验证失败
            ->first();
        if($infos){
            //判断上一次发送时间
            $finished_at = $infos['finished_at'];
            $now = time();
//            echo $now-$finished_at;
            if(($now-$finished_at)>60*5){//有效期5分钟
                $array['status'] = 'f';
                $array['code'] = 4000;
                $array['msg'] = '验证超时';
                $infos->status_check = 12;//验证失败
                $infos->check_at = Carbon\Carbon::now();//验证日期
//                $infos->save();
            }else{//
                $array['status'] = 's';
                $array['code'] = 1000;
                $array['msg'] = '验证通过';
                $infos->status_check = 11;//验证成功
                $infos->check_at = Carbon\Carbon::now();//验证日期
                $infos->save();
            }
        }else{
            $array['status'] = 'f';
            $array['code'] = 4000;
            $array['msg'] = '手机号码与验证码错误';
        }
        return $array;
    }
}
if(!function_exists('check_phone_unique'))
{
    function check_phone_unique($phone){
        $infos = \App\Models\UserModel::where('phone',$phone)->first();
        if($infos){
            $array['status'] = 'f';
            $array['code'] = 4000;
            $array['msg'] = '手机号码已存在';
        }else{
            $array['status'] = 's';
            $array['code'] = 1000;
            $array['msg'] = '手机号码不存在';
        }
        return $array;
    }
}
//记录发送日志
if(!function_exists('log_sms'))
{
    function log_sms($sms_array,$rs)
    {
        $input['phone'] = $sms_array['phone'];
        $input['code'] = $sms_array['code'];
        $input['type_send'] = $sms_array['type_send'];
        $input['content'] = $sms_array['temp_id'];
        $input['driver'] = $rs['logs'][0]['driver'];
        $started_at = explode(" ",$rs['logs'][0]['time']['started_at']);
        $finished_at = explode(" ",$rs['logs'][0]['time']['finished_at']);
        $input['started_at'] = $started_at[1];
        $input['finished_at'] = $finished_at[1];
        $input['info'] = json_encode($rs);
        if($rs['logs'][0]['success']){
            $input['status_send'] = 11;
        }else{
            $input['status_send'] = 10;
        }
        \App\Models\SmsLogModel::create($input);
    }
}
//隐藏手机号码中间的数据，替换为*号
if(!function_exists('phone_hidden')) {
    function phone_hidden($phone)
    {
        $str = substr_replace($phone,'****',3,4);
        return $str;
    }
}