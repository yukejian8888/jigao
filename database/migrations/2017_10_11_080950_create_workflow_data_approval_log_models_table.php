<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowDataApprovalLogModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflow_data_approval_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_data_id')->comment('审批单id');
            $table->integer('approval_user_id')->comment('审批会员列表的id');
            $table->integer('form_id')->comment('模板id');
            $table->mediumInteger('grade')->nullable()->comment('审批等级');
            $table->text('user_id')->nullable()->comment('审批人员id，json格式存储，不分先后');
            $table->smallInteger('number')->default('0')->comment('当前层级的审批人员数量');
            $table->smallInteger('number_agree')->default('0')->comment('已通过审批的人员数量');
            $table->smallInteger('number_disagree')->default('0')->comment('已驳回审批的人员数量');
            $table->smallInteger('status_check')->default('10')->comment('审批状态，10未进行审批，11审批中，12审批完成');
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
        Schema::dropIfExists('workflow_data_approval_log');
    }
}
