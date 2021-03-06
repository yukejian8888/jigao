<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSinglepageModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('singlepage', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('标题');
            $table->mediumInteger('sort_id')->comment('分类id');
            $table->smallInteger('status')->default('20')->comment('审核状态，10禁用，20启用');
            $table->text('content')->commnet('内容')->nullable();
            $table->mediumInteger('view')->default(0)->comment('浏览量');
            $table->string('keywords')->commnet('关键词')->nullable();
            $table->string('description')->commnet('描述')->nullable();
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
        Schema::dropIfExists('singlepage');
    }
}
