<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsIntegralModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings_integral', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('标题');
            $table->mediumInteger('number')->comment('操作积分数量')->default(0);
            $table->string('mark')->comment('标识符');
            $table->string('remark')->comment('备注')->nullable();
            $table->string('template')->comment('积分模板')->nullable();
            $table->smallInteger('type')->default('10')->comment('操作类型，10增加，11减少');
            $table->smallInteger('status')->default('20')->comment('审核状态，10禁用，20启用');
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
        Schema::dropIfExists('settings_integral');
    }
}
