<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleSortModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_sort', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->default('0')->comment('pid父级id');
            $table->string('name')->comment('分类名称');
            $table->smallInteger('status')->default('20')->comment('审核状态，10禁用，20启用');
            $table->string('path')->default(',')->comment('分类所在级别');
            $table->string('pic')->commnet('分类标题图片图标')->nullable();
            $table->string('tpl_list')->commnet('列表页模板')->nullable();
            $table->string('tpl_content')->commnet('内容页对应模板')->nullable();
            $table->string('keywords')->commnet('关键词')->nullable();
            $table->string('description')->commnet('描述')->nullable();
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
        Schema::dropIfExists('article_sort');
    }
}
