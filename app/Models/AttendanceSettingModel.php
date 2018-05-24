<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceSettingModel extends Model
{
    protected $table = 'attendance_setting';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['status','rule_name','need_attendance_people','check_in_time',
        'check_out_time','earliest_time','address','allow_late_time','allow_leave_time'];
}
