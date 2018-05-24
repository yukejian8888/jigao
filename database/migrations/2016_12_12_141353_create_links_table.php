<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('标题');
            $table->mediumInteger('sort_id')->comment('分类id');
            $table->text('url')->comment('地址')->nullable();
            $table->string('pic')->comment('图片')->nullable();
            $table->string('remark')->comment('备注')->nullable();
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
        Schema::dropIfExists('links');
    }
}
