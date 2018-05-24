<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('标题');
            $table->string('subtitle')->nullable()->comment('标题');
            $table->string('pic')->nullable()->comment('图片');
            $table->mediumInteger('sort_id')->comment('分类id');
            $table->string('remark')->comment('备注')->nullable();
            $table->string('keywords')->commnet('关键词')->nullable();
            $table->string('description')->commnet('描述')->nullable();
            $table->smallInteger('status')->default('20')->comment('审核状态，10禁用，20启用');
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
        Schema::dropIfExists('block');
    }
}
