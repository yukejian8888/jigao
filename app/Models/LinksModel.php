<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinksModel extends Model
{
    protected $table = 'links';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['title','sort_id','pic','url','status','order_by','remark'];

}
