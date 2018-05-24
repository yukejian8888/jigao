<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsLogModel extends Model
{
    protected $table = 'sms_log';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['id','phone','user_id','type_send','status_send','started_at','finished_at','driver','content','code','check_at','status_check','info'];
}
