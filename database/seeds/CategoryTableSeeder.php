<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
        	'name' => "休闲娱乐",
	        'pid' => 0,
	        'url' => "",
	        'hot' => 1,

        ]);


        $system = Category::create([
        	'name' => "运动健康",
	        'pid' => 0,

        ]);

        Category::create([
        	'name' => "带跑步",
	        'pid' => $system->id,
        ]);


    }
}
