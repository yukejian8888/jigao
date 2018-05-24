<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyItemModel extends Model
{
    protected $table = 'weekly_item';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['weekly_id','project_name','user_id','start_time','end_time','remark','actual_complete_time','complete_status','complete_remark'];
}
