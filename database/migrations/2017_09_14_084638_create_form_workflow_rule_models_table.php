<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormWorkflowRuleModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_workflow_rule', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_id')->comment('模板id');
            $table->mediumInteger('grade')->nullable()->comment('审批等级');
            $table->text('user_id')->nullable()->comment('审批人员id，json格式存储，不分先后');
            $table->smallInteger('status_check')->default('10')->comment('校验数据状态是否完善，如不完善不能发起审批，10未完善，20已完善');
            $table->smallInteger('type_approval')->default('10')->comment('审批签发类型，10会签（全部通过才能进入下一环节），11或签（有一个通过及进入下一环节）');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_workflow_rule');
    }
}
