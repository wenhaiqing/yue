<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Norm extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'cate_norm';

    protected $fillable = ['cate_id', 'title'];

    public function para()
    {
        return $this->hasMany('App\Models\Para','norm_id');
    }
}
