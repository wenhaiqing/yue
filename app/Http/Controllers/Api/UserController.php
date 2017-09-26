<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;


class UserController extends BaseController
{


    public function index(Request $request){

        return $request->user();
    }
    
    /*
     * app 用户修改个人资料
     */
    public function edit(Request $request){
        $user = $request->user();
        $attr = $request->all();
        if($attr['file']){
            $path = $this->uploadqiniu($attr['file']);
            if($path){
                $res['avatar'] = $path;
                $attr['avatar'] = $path;
            }
        }
        $uid = $user->id;
        $result =  User::where('id',$uid)->update($attr);
        if($result){
                $res['message'] = '更新成功';
                $res['status'] = '1';
        }else{
               $res['message'] = '更新失败';
                $res['status'] = '1';
        }
        return response()->json($res);
       // $result = UserRepositoryEloquent::update($request->all(), $uid);

    }
}