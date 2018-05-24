<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemMessageModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_message', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumInteger('user_id')->default(0)->comment('会员id');
            $table->smallInteger('status_read')->default('10')->comment('状态10未阅读，11已阅读');
            $table->text('action')->nullable()->comment('操作动作');
            $table->text('content')->nullable()->comment('操作事项-消息内容');
            $table->string('ip')->comment('ip地址')->nullable();
            $table->string('read_time')->comment('阅读时间')->nullable();
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
        Schema::dropIfExists('system_message');
    }
}
