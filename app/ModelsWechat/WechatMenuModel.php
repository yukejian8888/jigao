<?php

namespace App\ModelsWechat;

use Illuminate\Database\Eloquent\Model;

class WechatMenuModel extends Model
{
    protected $table = 'wechat_menu';

    protected  $fillable = [
        'user_id','key','url','order_by','type','pid','name','status',
    ];
}
