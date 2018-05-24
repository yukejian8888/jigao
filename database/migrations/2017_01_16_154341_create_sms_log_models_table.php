<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsLogModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone')->default('')->comment('手机号码');
            $table->mediumInteger('user_id')->default(0)->comment('会员id,备用');
            $table->smallInteger('type_send')->default('10')->comment('发送类型，10短信验证码，11短信通知');
            $table->smallInteger('status_send')->default('10')->comment('发送状态，10失败，11成功');
            $table->string('started_at')->default('')->comment('发送开始时间');
            $table->string('finished_at')->default('')->comment('发送完成时间');
            $table->string('driver')->default('')->comment('发送驱动例如：Alidayu');
            $table->string('content')->default('')->comment('发送内容');
            $table->string('code')->default('')->comment('验证码');
            $table->string('check_at')->default('')->comment('验证时间');
            $table->smallInteger('status_check')->default('10')->comment('验证状态，10未验证使用，11已验证使用，12验证失败');
            $table->text('info')->comment('包含回调的全部信息，json格式存储');
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
        Schema::dropIfExists('sms_log');
    }
}
