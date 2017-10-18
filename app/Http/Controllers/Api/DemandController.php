<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Demand;
use Cache;

class DemandController extends Controller
{
    /*
     * APP获取需求
     */
    public function index(){
        if (Cache::has(config('admin.global.cache.app_demandList'))) {
            $demand = Cache::get(config('admin.global.cache.app_demandList'));
        }else{
            $demand = Demand::all();
            Cache::forever(config('admin.global.cache.app_demandList'),$demand);
        }
        $demand = Demand::all();
        $data['demand'] = $demand;
        return response()->json($data);
    }
    /*
     * APP添加需求发布者
     */
    public function add(Request $request){
        $user = $request->user();
        $res = $request->all();
        $res['uid'] = $user->id;
        $demand = Demand::create($res);
        if ($demand){
            Cache::forget(config('admin.global.cache.app_demandList'));
            $data['status'] = 1;
            $data['message'] = '添加成功';
            $data['data'] = $demand;
        }else{
            $data['status'] = 0;
            $data['message'] = '添加失败';
        }

        return response()->json($data);
    }
    

}
