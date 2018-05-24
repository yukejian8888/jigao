<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaModel extends Model
{
    protected $table = 'area';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['id','pid','name','pinyin','keywords','description','order_by','status','path'];
}
