<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManageGroupModel extends Model
{
    protected $table = 'manage_group';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['name','mark','remark','status_system','status_default'];
}
