<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorysTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->default(0)->comment('分类关系');
            $table->string('name')->default('')->comment('分类名称');
            $table->string('url')->default('')->comment('分类链接地址');
            $table->string('description')->default('')->comment('描述');
			$table->tinyInteger('hot')->default(0)->comment('是否热门分类,1为热门');
            $table->tinyInteger('sort')->default(0)->comment('排序');
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
		Schema::drop('categories');
	}

}
