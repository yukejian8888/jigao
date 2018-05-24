<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleAuthorityModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_authority', function (Blueprint $table) {
            $table->increments('id');

            $table->string('role_id')->comment('角色id');
            $table->string('authority_id')->comment('权限id');
            $table->smallInteger('add_user_id')->default('0')->comment('添加者id');

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
        Schema::dropIfExists('role_authority_models');
    }
}
