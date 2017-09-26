<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Services\Admin\UserService;
class UserController extends Controller
{

    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    public function index(Request $request){

        return $request->user();
    }
    
    /*
     * app 用户修改个人资料
     */
    public function edit(Request $request){
        $user = $request->user();

        $uid = $user->id;
        //$result =  User::where('id',$uid)->update($attr);
        $result = $this->service->app_update($attr,$uid);
        if($result){
                $res['message'] = '更新成功';
                $res['status'] = '1';
        }else{
               $res['message'] = '更新失败';
                $res['status'] = '1';
        }
        return response()->json($res);
    }
    /*
     * 修改头像
     */
    public function uploadavatar(Request $request){
        $attr = $request->all();
        if($attr['file']){
            $path = $this->uploadqiniu($attr['file']);
            if($path){
                return $path;
            }
        }
    }
}