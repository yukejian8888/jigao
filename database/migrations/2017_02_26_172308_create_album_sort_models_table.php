<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumSortModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_sort', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0)->comment('会员id');
            $table->string('name')->comment('分类名称')->nullable();
            $table->integer('pid')->default('0')->comment('pid父级id');
            $table->string('description')->comment('描述')->nullable();
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
        Schema::dropIfExists('album_sort');
    }
}
