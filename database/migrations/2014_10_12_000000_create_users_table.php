<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('用户名');
            $table->string('email')->nullable()->comment('email');
            $table->string('phone')->nullable()->comment('手机号码');
            $table->string('truename')->nullable()->comment('真实姓名');
            $table->string('password')->comment('密码');
            $table->mediumInteger('com_id')->default('0')->comment('单位id');
            $table->mediumInteger('office_id')->default('0')->comment('职务id');

            $table->smallInteger('status')->default('20')->comment('用户状态，10禁用，20启用，11删除');
            $table->smallInteger('sex')->default('10')->comment('用户性别，性别，10男，11女，12保密');
            $table->string('department')->nullable()->comment('所属部门');
            $table->string('homeaddress')->nullable()->comment('家庭地址');
            $table->string('authority')->nullable()->comment('用户权限');
            $table->string('role_id')->nullable()->comment('角色id');

            $table->string('remarks')->nullable()->comment('备注');
            $table->string('birthday')->nullable()->comment('出生年月');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
