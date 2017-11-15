<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeohashTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geohash', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->unsigned()->comment('用户ID');
            $table->string('geohash')->index()->default('')->comment('转换为hash字符串')->nullable();
            $table->string('lat')->default('')->nullable();
            $table->string('lon')->default('')->nullable();
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
        Schema::dropIfExists('geohash');
    }
}
