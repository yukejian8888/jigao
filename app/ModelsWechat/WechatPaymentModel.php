<?php

namespace App\ModelsWechat;

use Illuminate\Database\Eloquent\Model;

class WechatPaymentModel extends Model
{
    protected $table = 'wechat_payment';

    protected  $fillable = [
        'user_id','name','merchant_id','key','status'
    ];
}
