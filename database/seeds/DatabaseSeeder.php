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
        $this->call(GeoTableSeeder::class);
//        $this->call(RoleTableSeeder::class);
//        $this->call(MenuTableSeeder::class);
//        $this->call(PermissionTableSeeder::class);
//        $this->call(UsersTableSeeder::class);

    }
}
