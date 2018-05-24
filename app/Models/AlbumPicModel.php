<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumPicModel extends Model
{
    protected $table = 'album_pic';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['title','user_id','sort_id','filename','filepath','size','width','height','mime','description','status_lock'];
}
