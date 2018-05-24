<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinksSortModel extends Model
{
    protected $table = 'links_sort';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['name','status'];
}
