<?php

use Illuminate\Database\Seeder;
use App\Models\Geohash;

class GeoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Geohash::create([
            'uid' => "10",
            'lat' => '37.81408715269776',
            'lon' => "112.5626668351634",
        ]);
        Geohash::create([
            'uid' => "11",
            'lat' => '37.81808715269776',
            'lon' => "112.5646668351634",
        ]);
        Geohash::create([
            'uid' => "12",
            'lat' => '37.81448715269776',
            'lon' => "112.5624668351634",
        ]);
        Geohash::create([
            'uid' => "13",
            'lat' => '37.81403715269776',
            'lon' => "112.5623668351634",
        ]);
        Geohash::create([
            'uid' => "14",
            'lat' => '37.84408715269776',
            'lon' => "112.5426668351634",
        ]);
        //
    }
}
