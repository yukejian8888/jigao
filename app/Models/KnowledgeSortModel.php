<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KnowledgeSortModel extends Model
{
    protected $table = 'knowledge_sort';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['user_id','name','keywords','description','order_by','status'];
}
