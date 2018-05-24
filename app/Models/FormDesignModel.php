<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormDesignModel extends Model
{
    protected $table = 'form_design';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['user_id','title','sort_id','content_design','content_design_parse',
        'content_design_data','fields','status_check','remark','status_file','content_design_parse_all'];
}
