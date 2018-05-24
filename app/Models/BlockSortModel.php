<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockSortModel extends Model
{
    protected $table = 'block_sort';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['pid','name','keywords','description','order_by','status'];
}
