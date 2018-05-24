<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceModel extends Model
{
    protected $table = 'attendance';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['user_id','now_time','status_work','check_in_time',
        'check_out_time','status_should','status_really','over_time','status_over_time','is_click','ip'];
}
