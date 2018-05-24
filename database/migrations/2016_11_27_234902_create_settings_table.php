<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('config_name')->unique()->comment('参数名称供调用cfg_*');
            $table->string('name')->comment('参数名称')->nullable();
            $table->text('config_value')->comment('参数值')->nullable();
            $table->text('config_value_list')->comment('参数初始值选择项，主要用于radio、checkbox、select列表配合input_type使用')->nullable();
            $table->string('config_info')->comment('参数说明信息')->nullable();
            $table->string('input_type')->comment('input表单类型,text,radio,textarea');
            $table->smallInteger('group_id')->default('10')->comment('分组id');
            $table->smallInteger('order_by')->default('0')->comment('排序');
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
        Schema::dropIfExists('settings');
    }
}
