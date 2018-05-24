<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceSettingModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rule_name')->comment('考勤规则名称')->nullable();
            $table->string('status')->comment('状态，10 禁用，20启用')->nullable();
            $table->text('need_attendance_people')->comment('需要考勤的人员')->nullable();
            $table->string('check_in_time')->comment('签到时间')->nullable();
            $table->string('check_out_time')->comment('签退时间')->nullable();
            $table->string('earliest_time')->comment('最早考勤时间')->nullable();
            $table->string('earliest_time')->comment('最早考勤时间')->nullable();
            $table->string('allow_late_time')->comment('允许最长迟到时间')->nullable();
            $table->string('allow_leave_time')->comment('允许早退时间')->nullable();
            $table->text(']address')->comment('考勤范围')->nullable();
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
        Schema::dropIfExists('attendance_setting_models');
    }
}
