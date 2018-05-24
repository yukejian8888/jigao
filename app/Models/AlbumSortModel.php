<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumSortModel extends Model
{
    protected $table = 'album_sort';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['user_id','name','pid','description'];
}
