<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Demand;
use Cache;

class DemandController extends Controller
{
    /*
     * APP获取技师
     */
    public function index(){
//        if (Cache::has(config('admin.global.cache.app_skillerList'))) {
//            $demand = Cache::get(config('admin.global.cache.app_skillerList'));
//        }else{
//            $demand = Skiller::all();
//            Cache::forever(config('admin.global.cache.app_skillerList'),$demand);
//        }
        $demand = Demand::all();
        $data['demand'] = $demand;
        return response()->json($data);
    }
    /*
     * APP添加技师
     */
    public function add(Request $request){
        $res = $request->all();
       // $res['para_id'] = serialize($res['para_id']);
        $demand = Demand::create($res);
        if ($demand){
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
