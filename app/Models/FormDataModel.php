<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormDataModel extends Model
{
    protected $table = 'form_data';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['form_id','title','user_id','content','content_design',
        'content_design_parse','content_design_data','content_design_parse_all','file','fields','status_approval'];
}
