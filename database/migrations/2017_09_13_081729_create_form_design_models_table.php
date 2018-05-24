<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormDesignModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_design', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('表单标题');
            $table->mediumInteger('sort_id')->comment('所属分类id');
            $table->text('content_design')->comment('表单原html模板未经处理的')->nullable();
            $table->text('content_design_parse')->comment('表单替换的模板 经过处理')->nullable();
            $table->text('content_design_data')->comment('表单中的字段数据')->nullable();
            $table->text('content_design_parse_all')->comment('记录所有解析返回的结果数据json格式')->nullable();
            $table->smallInteger('fields')->comment('字段数')->nullable();
            $table->smallInteger('status_check')->default('20')->comment('审核状态，10禁用，20启用');
            $table->string('remark')->comment('备注')->nullable();
            $table->smallInteger('status_file')->default('10')->comment('是否需要上传附件，10不需要，20需要');
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
        Schema::dropIfExists('form_design');
    }
}
