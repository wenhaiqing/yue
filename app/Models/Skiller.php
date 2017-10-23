<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Skiller extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'skiller';

    protected $fillable = ['uid','cate_id','para_id', 'introduce', 'difference', 'price', 'location', 'location_x','location_y','education','job','prize','question','photo','video'];

    public function user(){
        return $this->hasOne('App\User','id','uid');
    }

    public function cate()
    {
        return $this->hasOne('App\Models\Category','id','cate_id');
    }

    public function picture()
    {
        return $this->hasMany('App\Models\Picture','sid');
    }

    public function video()
    {
        return $this->hasMany('App\Models\video','sid');
    }

}
