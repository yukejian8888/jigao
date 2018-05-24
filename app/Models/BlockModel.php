<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockModel extends Model
{
    protected $table = 'block';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['title','subtitle','pic','sort_id','order_by','keywords','description','remark','status'];

}
