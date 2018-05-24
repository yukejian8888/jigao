<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiModel extends Model
{
    protected $table = 'api';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['id','title','key','secret','status','remark'];

}
