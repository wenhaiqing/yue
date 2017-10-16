<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Skiller;
use Cache;
use App\Models\Norm;

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

        return response()->json($skill);
    }



}
