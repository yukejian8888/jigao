<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyModel extends Model
{
    protected $table = 'weekly';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['user_id','title','plan_remark','complete_remark','complete_status','submit_status'];
}
