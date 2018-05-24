<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkWeeklyModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_item', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumInteger('weekly_id')->comment('周报id')->nullable();
            $table->string('project_name')->comment('项目名称')->nullable();
            $table->mediumInteger('user_id')->comment('会员id')->nullable();
            $table->mediumInteger('start_time')->comment('计划开始时间')->nullable();
            $table->mediumInteger('end_time')->comment('计划完成时间')->nullable();
            $table->string('remark')->comment('备注')->nullable();
            $table->mediumInteger('actual_complete_time')->comment('实际完成时间')->nullable();
            $table->smallInteger('complete_status')->default('10')->comment('完成情况，10未开始，20进行中，21已完成')->nullable();
            $table->string('complete_remark')->comment('完成备注')->nullable();
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
        Schema::dropIfExists('weekly_item');
    }
}
