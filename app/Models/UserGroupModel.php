<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroupModel extends Model
{
    protected $table = 'user_group';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['user_id','group_id','status_auth'];
}
