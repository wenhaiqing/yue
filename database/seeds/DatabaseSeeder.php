<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        $this->call(CategoryTableSeeder::class);
=======
        //$this->call(CategoryTableSeeder::class);
>>>>>>> 3737686cb3a31e3558b1f97d1570ff8ae4659a49
        $this->call(RoleTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(UsersTableSeeder::class);

    }
}
