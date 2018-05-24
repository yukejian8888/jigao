<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KnowledgeModel extends Model
{
    protected $table = 'knowledge';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['title','subtitle','pic','sort_id','user_id','flag','keywords','description','content','status','view','num_comment'];
}
