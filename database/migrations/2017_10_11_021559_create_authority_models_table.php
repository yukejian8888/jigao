<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorityModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authority', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->comment('权限名');
            $table->string('status')->default('10')->comment('状态10启用，20禁用');
            $table->smallInteger('pid')->default('0')->comment('父级权限ID');
            $table->string('authority_route')->nullable()->comment('路由');
            $table->string('remarks')->nullable()->comment('备注');

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
        Schema::dropIfExists('authority_models');
    }
}
