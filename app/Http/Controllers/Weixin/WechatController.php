<?php

namespace App\Http\Controllers\Weixin;

use App\ModelsWechat\WechatInfoModel;
use App\ModelsWechat\WechatSettingsModel;
use \Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\News;
use Illuminate\Support\Facades\Session;
use EasyWeChat\Message\Text;


class WechatController extends BaseController
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

    public function server()
    {
        $options = get_wechat_options();
        $app = new Application($options);
        $server = $app->server;
        $user = $app->user;
        $server->setMessageHandler(function($message) use ($user) {
//            $fromUser = $user->get($message->FromUserName);
//            return "{$fromUser->nickname} 您好！欢迎关注 overtrue!";


            switch ($message->MsgType) {
                case 'event':
                    # 事件消息...
                    if($message->Event=='subscribe'):
                        return $this->response_info('subscribe');
                    elseif ($message->Event=='unsubscribe'):
                            return "您好！取消关注我!";
                    elseif ($message->Event=='SCAN'):
                    elseif ($message->Event=='LOCATION'):
                    elseif ($message->Event=='CLICK'):
                    elseif ($message->Event=='VIEW'):
                    endif;
                    break;
                case 'text':
                    # 文字消息...
                    $word = $message->Content;
                    return $this->response_info('text',$word);
                    break;
                case 'image':
                    # 图片消息...
                    return 'img：'.$message->ToUserName.'()'.$message->FromUserName.'()'.$message->PicUrl;
                    break;
                case 'voice':
                    # 语音消息...
                    break;
                case 'video':
                    # 视频消息...
                    break;
                case 'location':
                    # 坐标消息...
                    break;
                case 'link':
                    # 链接消息...
                    break;
                // ... 其它消息
                default:
                    # code...
                    break;
            }

        });

        $server->serve()->send();
    }

    /**
     * 响应事件
     * @param string $event
     */
    public function response_info($event='text',$word='')
    {
        /**
         * type_event 10关注事件，11自定义菜单事件，20普通事件
         * type_reply_info 10文本消息，15图文消息
         */
        if($event=='subscribe'){//订阅关注事件
            $response = $this->get_news('10');
        }elseif ($event=='text'){//普通事件
            $response = $this->get_news('20',$word);
        }elseif ($event=='click'){//自定义菜单点击事件
            $response = $this->get_news('11');
        }
        return $response;
    }

    /**
     * 获取数据，及获取数据后数据的处理
     * @param string $event
     * @return array|Text
     */
    public function get_news($type_event='12',$word='')
    {
        $model = new WechatInfoModel();
        /**
         * type_event 10关注事件，11自定义菜单事件，20普通事件
         * type_reply_info 10文本消息，15图文消息
         * 先判断图文，再判断文字
         */
        $type_reply_info = 15;//type_reply_info 10文本消息，15图文消息
        $infos_pic = array();
        if($type_event=='10'){
            $infos_pic = $model::where('status',20)->where('type_event',$type_event)->where('type_reply_info',$type_reply_info)->take(8)->get()->toArray();
        }elseif($type_event=='11'){
            $infos_pic = $model::where('status',20)->where('type_event',$type_event)->where('type_event_key','like','%'.$word.'%')->where('type_reply_info',$type_reply_info)->take(8)->get()->toArray();
        }elseif($type_event=='20'){
            $infos_pic = $model::where('status',20)->where('type_event',$type_event)->where('keyword',$word)->where('type_reply_info',$type_reply_info)->take(8)->get()->toArray();
        }
        //判断是否存在图文消息
        if($infos_pic):
            $array = [];
            foreach ($infos_pic as $k=>$v){
                $news = new News([
                    'title'       => $word.$v['title'],
                    'description' => $v['content'],
                    'url'         => $v['url'],
                    'image'       => check_pic_url($v['pic']),
                    // ...
                ]);
                $array[$k] = $news;
            }
            $infos_response = $array;
        else:
            $infos_text = array();
            $type_reply_info = 10;//type_reply_info 10文本消息，15图文消息
            if($type_event=='10'){
                $infos_text = $model::where('status',20)->where('type_event',$type_event)->where('type_reply_info',$type_reply_info)->first();
            }elseif($type_event=='11'){
                $infos_text = $model::where('status',20)->where('type_event',$type_event)->where('type_event_key','like','%'.$word.'%')->where('type_reply_info',$type_reply_info)->first();
            }elseif($type_event=='20'){
                $infos_text = $model::where('status',20)->where('type_event',$type_event)->where('keyword',$word)->where('type_reply_info',$type_reply_info)->first();
            }

            if($infos_text){
                $infos_text->toArray();
                $content = $infos_text['content'];
            }else{
                $content = '暂无数据';
            }
            $text = new Text();
            $text->content = $content;
            $infos_response = $text;
        endif;
        return $infos_response;
    }
    //调试用
    public function weixin()
    {
        $options = get_wechat_options();
        $app = new Application($options);
        $oauth = $app->oauth;
        if(!session()->has('wechat_user')):
            session(['target_url'=>route('weixin.index')]);
            return $oauth->redirect();
        // 这里不一定是return，如果你的框架action不是返回内容的话你就得使用
        // $oauth->redirect()->send();

        endif;
        $user = session('wechat_user');
        dd($user);
    }

    /**
     * oauth_callback
     * 授权回调
     */
    public function oauth_callback()
    {
        $options = get_wechat_options();
        $app = new Application($options);
        $oauth = $app->oauth;
        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        $array_callback = $user->toArray();

        oauth_check('wechat',$array_callback);//记录回调数据
        session(['wechat_user'=>$array_callback]);//存储回调数据
        //查询会员信息
        $infos = get_oauth_user_id_by_open_id($array_callback['id']);
        if($infos['user_id'])://存在
            Session::put('user_login_status',true);
            Session::put('user_id',$infos['id']);
            Session::put('user_name',$array_callback['name']);
            $targetUrl = session()->has('target_url')?session('target_url'):'/';
            header('location:'. $targetUrl); // 跳转到 user/profile
        else://不存在,跳转到绑定页面
            return redirect()->route('weixin.login');
        endif;

    }
}
