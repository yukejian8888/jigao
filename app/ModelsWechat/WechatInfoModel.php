<?php

namespace App\ModelsWechat;

use Illuminate\Database\Eloquent\Model;

class WechatInfoModel extends Model
{
    protected $table = 'wechat_info';

    protected  $fillable = [
        'user_id','title','keyword','pic','status','type_info','type_event','order_by','content','url','type_reply_info','type_event_key'
    ];
}
