<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailSettingsModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('名称');
            $table->string('driver')->comment('驱动smtp等')->nullable();
            $table->string('host')->comment('发送服务器')->nullable();
            $table->string('port')->comment('端口')->nullable();
            $table->string('username')->comment('用户名')->nullable();
            $table->string('password')->comment('独立密码')->nullable();
            $table->string('sendmail')->comment('')->default('/usr/sbin/sendmail -bs');
            $table->boolean('encryption')->comment('加密方式ssl\tsl')->nullable();
            $table->boolean('pretend')->comment('')->default(false);
            $table->string('from_address')->comment('发送电子邮件地址')->nullable();
            $table->string('from_name')->comment('发送邮件名')->nullable();
            $table->string('match')->comment('匹配参数')->nullable();
            $table->smallInteger('is_default')->default('10')->comment('是否为默认发送服务器，20是，10否');
            $table->smallInteger('status')->default('20')->comment('状态，10禁用，20启用');
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
        Schema::dropIfExists('mail_settings');
    }
}
