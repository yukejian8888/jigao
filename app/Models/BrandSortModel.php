<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandSortModel extends Model
{
    protected $table = 'brand_sort';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['id','pid','name','keywords','description','order_by','status'];
}
