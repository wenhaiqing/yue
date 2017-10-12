<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Para extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'cate_para';

    protected $fillable = ['norm_id', 'name'];
}
