<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SinglepageModel extends Model
{
    protected $table = 'singlepage';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['title','sort_id','keywords','description','content','status'];
}
