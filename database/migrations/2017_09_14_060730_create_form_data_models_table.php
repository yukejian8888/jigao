<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormDataModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_id')->comment('模板id');
            $table->string('title')->comment('项目名称');
            $table->mediumInteger('user_id')->comment('会员id');
            $table->text('content')->comment('存储模板表单中用户填写的数据')->nullable();
            $table->text('content_design')->comment('表单原html模板未经处理的')->nullable();
            $table->text('content_design_parse')->comment('表单替换的模板 经过处理')->nullable();
            $table->text('content_design_data')->comment('表单中的字段数据')->nullable();
            $table->text('content_design_parse_all')->comment('记录所有解析返回的结果数据json格式')->nullable();
            $table->text('file')->comment('存储用户上传的附件')->nullable();
            $table->smallInteger('fields')->comment('字段数')->nullable();
            $table->smallInteger('status_approval')->default('10')->comment('审批状态，10待审批，11审批中，12已驳回，20已审批');
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
        Schema::dropIfExists('form_data');
    }
}
