<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Skiller;
use Cache;

class SkillerController extends Controller
{
    /*
     * APP获取技师
     */
    public function index(){
        if (Cache::has(config('admin.global.cache.app_skillerList'))) {
            $skill = Cache::get(config('admin.global.cache.app_skillerList'));
        }else{
            $skill = Skiller::all();
            Cache::forever(config('admin.global.cache.app_skillerList'),$skill);
        }

        $data['skill'] = $skill;
        return response()->json($data);
    }
    /*
     * APP添加技师
     */
    public function add(Request $request){
        $res = $request->all();
        $user = $request->user();
        $res['uid'] = $user->id;
        $skill = Skiller::create($res);
        if ($skill){
            Cache::forget(config('admin.global.cache.app_skillerList'));
            $data['status'] = 1;
            $data['message'] = '添加成功';
            $data['data'] = $skill;
        }else{
            $data['status'] = 0;
            $data['message'] = '添加失败';
        }

        return response()->json($data);
    }

    /*
     * app 更新技师信息
     */
    public function update(Request $request)
    {
        $res = $request->all();
        $id = $res['id'];
        $result = Skiller::where('id',$id)->update($res);
        if ($result){
            Cache::forget(config('admin.global.cache.app_skillerList'));
            $data['status'] = 1;
            $data['message'] = '更新成功';
        }else{
            $data['status'] = 0;
            $data['message'] = '更新失败';
        }
        return response()->json($data);
    }

    /*
     * APP上传技师图片
     */
    public function upload(Request $request)
    {
        $attr = $request->all();
        $user = $request->user();
        $uid = $user->id;
        $attr['file'] = $_FILES["file"];
        return response()->json($attr);
//        if($attr['file']){
//            $path = $this->app_uploadqiniu($attr['file']);
//            if($path){
//                $res['avatar'] = $path;
//                $result = $this->service->app_update($res,$uid);
//                if($result){
//                    $res['message'] = '更新成功';
//                    $res['status'] = '1';
//                }else{
//                    $res['message'] = '更新失败';
//                    $res['status'] = '0';
//                }
//                return response()->json($res);
//            }
//        }
    }



}
