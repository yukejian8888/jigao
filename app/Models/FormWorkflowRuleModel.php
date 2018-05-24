<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormWorkflowRuleModel extends Model
{
    protected $table = 'form_workflow_rule';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['form_id','grade','user_id','type_approval','status_check'];
}
