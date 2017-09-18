<?php
/**
 * Created by PhpStorm.
 * User: wenhaiqing
 * Date: 2017/9/18
 * Time: 16:00
 */

namespace App\Http\Controllers\Api;

class IndexController extends ApiController
{
    public function index(){

        return $this->message('请求成功');
    }
}