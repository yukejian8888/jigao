<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumPicModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_pic', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0)->comment('会员id');
            $table->string('title')->nullable()->comment('图片名称');
            $table->mediumInteger('sort_id')->default(0)->nullable()->comment('分类id');
            $table->text('filename')->comment('文件名称')->nullable();
            $table->text('filepath')->comment('存储路径')->nullable();
            $table->string('size')->comment('图片大小')->nullable();
            $table->string('width')->comment('图片宽度')->nullable();
            $table->string('height')->comment('图片高度')->nullable();
            $table->string('mime')->comment('类型')->nullable();
            $table->string('description')->comment('描述')->nullable();
            $table->smallInteger('status_lock')->default(10)->nullable()->comment('图片锁定状态，10不锁定，11暂时锁定，12永久锁定');
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
        Schema::dropIfExists('album_pic');
    }
}
