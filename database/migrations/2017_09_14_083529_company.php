<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Company extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('com_name')->comment('单位名');
            $table->string('com_address')->comment('单位地址');
            $table->string('com_telphone')->nullable()->comment('单位电话');
            $table->string('contact')->nullable()->comment('联系人名');
            $table->string('contact_telphone')->nullable()->comment('联系电话');
            $table->smallInteger('com_status')->default('10')->comment('单位状态:10启用,11禁用，12拉黑，13冻结');
            $table->smallInteger('own')->default('10')->comment('甲方单位为10，非甲方单位为11');
            $table->mediumInteger('shorthand')->nullable()->comment('单位简写');
            $table->mediumInteger('remarks')->nullable()->comment('备注');

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
        //
    }
}
