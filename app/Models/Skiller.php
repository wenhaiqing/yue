<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Skiller extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'skiller';

    protected $fillable = ['cate_id','para_id', 'introduce', 'difference', 'price', 'location', 'location_x','location_y','education','job','prize','question','photo','video'];


}
