<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeeklyListModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumInteger('user_id')->comment('会员id')->nullable();
            $table->string('title')->comment('周报名称');
            $table->string('plan_remark')->comment('计划备注');
            $table->string('complete_remark')->comment('完成备注');
            $table->smallInteger('submit_status')->default('10')->comment('提交状态，10未提交，11上报提交，20汇报提交')->nullable();
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
        Schema::dropIfExists('weekly');
    }
}
