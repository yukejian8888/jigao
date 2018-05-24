<?php

namespace App\ModelsWechat;

use Illuminate\Database\Eloquent\Model;

class WechatSettingsModel extends Model
{
    protected $table = 'wechat_settings';

    protected  $fillable = [
        'user_id','name','number','app_id','secret','token','aes_key','status','pic'
    ];
}
