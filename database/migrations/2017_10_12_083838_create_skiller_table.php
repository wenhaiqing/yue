<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skiller', function (Blueprint $table) {
            $table->increments('id');
            $table->string('para_id')->default('')->comment('技师选择分类参数ID')->nullable();
            $table->string('introduce')->default('')->comment('服务介绍')->nullable();
            $table->string('difference')->default('')->comment('不同点')->nullable();
            $table->string('price')->default('')->comment('各规格参数价格')->nullable();
            $table->string('location')->default('')->comment('定位地址')->nullable();
            $table->string('location_x')->default('')->nullable();
            $table->string('location_y')->default('')->nullable();
            $table->string('education')->default('')->comment('教育经历')->nullable();
            $table->string('job')->default('')->comment('工作经历')->nullable();
            $table->string('prize')->default('')->comment('奖项')->nullable();
            $table->string('question')->default('')->comment('专业问题')->nullable();
            $table->string('photo')->default('')->comment('技能照片多张')->nullable();
            $table->string('video')->default('')->comment('技能视频介绍')->nullable();
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
        Schema::dropIfExists('skiller');
    }
}
