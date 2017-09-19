<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            'name' => 'Laravel Personal Access Client',
            'secret' => 'bN5wOdoHs0aHmt43cVGqhYerH2Ch3ZEsMVXUaZ0Q',
            'redirect' => 'http://yue.zdxinfo.com',
            'personal_access_client' =>1,
            'password_client' =>0,
            'revoked' =>0,
            'created_at' => '2017-09-19 22:09:09',
            'updated_at' => '2017-09-19 22:09:09'
        ]);

        DB::table('oauth_clients')->insert([
            'name' => 'Laravel Password Grant Client',
            'secret' => 'UqqeT72Zsx5ZvS92bDj6qM18ocrg9Bmep49OyTni',
            'redirect' => 'http://yue.zdxinfo.com',
            'personal_access_client' =>0,
            'password_client' =>1,
            'revoked' =>0,
            'created_at' => '2017-09-19 22:09:09',
            'updated_at' => '2017-09-19 22:09:09'
        ]);
    }
}
