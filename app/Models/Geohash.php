<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Geohash extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "geohash";

    protected $fillable = ['uid', 'geohash', 'lat', 'lon'];

}
