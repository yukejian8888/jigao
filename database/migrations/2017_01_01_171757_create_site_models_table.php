<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->default('0')->comment('备用父级id');
            $table->string('name')->comment('名称');
            $table->string('pinyin')->nullable()->comment('拼音');
            $table->mediumInteger('area_id')->default(0)->comment('地区id');
            $table->string('keywords')->nullable()->comment('关键词');
            $table->string('description')->nullable()->comment('描述');
            $table->string('remark')->nullable()->comment('备注');
            $table->mediumInteger('order_by')->default('0')->comment('排序');
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
        Schema::dropIfExists('site');
    }
}
