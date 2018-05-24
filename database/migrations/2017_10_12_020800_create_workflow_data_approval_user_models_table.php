<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowDataApprovalUserModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflow_data_approval_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_data_id')->comment('审批单id');
            $table->mediumInteger('grade')->nullable()->comment('审批等级');
            $table->mediumInteger('user_id')->nullable()->comment('审批人员id');
            $table->smallInteger('status_check')->default('10')->comment('审批状态，10未进行审批，11驳回，12同意');
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
        Schema::dropIfExists('workflow_data_approval_user');
    }
}
