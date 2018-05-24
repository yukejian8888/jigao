<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteModel extends Model
{
    protected $table = 'site';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['id','pid','name','pinyin','area_id','keywords','description','order_by','status','remark'];
}
