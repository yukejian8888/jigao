<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumInteger('user_id')->comment('会员id')->nullable();
            $table->string('now_time')->comment('当前日期')->nullable();
            $table->smallInteger('status_check_in')->comment('签到状态，10已签到，11未签到，12迟到')->nullable();
            $table->smallInteger('status_check_out')->comment('签退状态，10已签退，12未签退，12早退')->nullable();

            $table->string('check_in_time')->comment('签到时间')->nullable();
            $table->string('check_out_time')->comment('签退时间')->nullable();
            $table->smallInteger('status_should')->comment('应到，10应到，20未到')->nullable();
            $table->smallInteger('status_really')->comment('实到，10实到，20未到')->nullable();
            $table->mediumInteger('late_time')->comment('迟到时间')->nullable();
            $table->mediumInteger('leave_early_time')->comment('早退时间')->nullable();
            $table->mediumInteger('over_time')->comment('加班时间')->nullable();
            $table->smallInteger('status_over_time')->comment('加班的日期状态，10平日，20周末，30节假日')->nullable();
            $table->smallInteger('is_click')->comment('是否点击，10已点击，20未点击')->nullable();
            $table->string('ip')->comment('IP地址')->nullable();
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
        Schema::dropIfExists('attendance_models');
    }
}

