<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demand', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cate_id')->default('')->comment('分类ID')->nullable();
            $table->string('para_id')->default('')->comment('需求选择规格参数ID')->nullable();
            $table->string('yuetime')->default('')->comment('预约时间')->nullable();
            $table->string('validday')->default('')->comment('有效期天数')->nullable();
            $table->string('validtime')->default('')->comment('有效期时间')->nullable();
            $table->string('needpara')->default('')->comment('需求详情')->nullable();
            $table->string('sincerity')->default('')->comment('诚意金')->nullable();
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
        Schema::dropIfExists('demand');
    }
}
