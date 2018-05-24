<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManageGroupModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_group', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('名称');
            $table->string('mark')->comment('标识符，系统状态的标识符禁止修改（后台管理员manage、前台个人用户member_personal）');
            $table->string('remark')->comment('备注')->nullable();
            $table->smallInteger('status_system')->default('11')->nullable()->comment('系统状态（系统状态禁止删除），10系统级，11用户级');
            $table->smallInteger('status_default')->default('11')->nullable()->comment('是否默认状态，10是，11否');
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
        Schema::dropIfExists('manage_group');
    }
}
