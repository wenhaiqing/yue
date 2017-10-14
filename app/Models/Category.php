<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Category extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['pid', 'name', 'url', 'hot', 'description', 'sort'];

    public function norm()
    {
        return $this->hasMany('App\Models\Norm','cate_id');
    }
}
