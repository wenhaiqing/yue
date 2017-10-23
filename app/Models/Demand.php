<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Demand extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'demand';

    protected $fillable = ['uid','cate_id','para_id', 'validday', 'validtime', 'yuetime', 'needpara', 'sincerity'];

    public function user(){
        return $this->hasOne('App\User','id','uid');
    }

    public function cate()
    {
        return $this->hasOne('App\Models\Category','id','cate_id');
    }

}
