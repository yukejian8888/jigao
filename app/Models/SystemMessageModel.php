<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemMessageModel extends Model
{
    protected $table = 'system_message';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['user_id','status_read','action','content','ip','read_time'];
}
