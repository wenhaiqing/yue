<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgeToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table)
        {
            $table->renameColumn('username', 'phone');
            $table->string('sex')->default('男')->comment('性别')->nullable();
            $table->tinyInteger('age')->default(0)->comment('年龄')->nullable();
            $table->string('weixin')->default('')->comment('微信号')->nullable();
            $table->string('company')->default('')->comment('公司单位')->nullable();
            $table->string('introduction')->default('')->comment('我的简介')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
