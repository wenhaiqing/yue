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
//        if (Cache::has(config('admin.global.cache.app_skillerList'))) {
//            $skill = Cache::get(config('admin.global.cache.app_skillerList'));
//        }else{
//            $skill = Skiller::all();
//            Cache::forever(config('admin.global.cache.app_skillerList'),$skill);
//        }
        $skill = Skiller::all();
        $skill[0]['para_id'] = unserialize($skill[0]['para_id']);

        $data['skill'] = $skill;
        return response()->json($data);
    }
    /*
     * APP添加技师
     */
    public function add(Request $request){
        $res = $request->all();
       // $res['para_id'] = serialize($res['para_id']);
        $skill = Skiller::create($res);
        if ($skill){
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
            $data['status'] = 1;
            $data['message'] = '更新成功';
        }else{
            $data['status'] = 0;
            $data['message'] = '更新失败';
        }
        return response()->json($data);
    }



}
