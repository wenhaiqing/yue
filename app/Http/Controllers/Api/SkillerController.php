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
        if (Cache::has(config('admin.global.cache.app_skillerList'))) {
            $category = Cache::get(config('admin.global.cache.app_skillerList'));
        }else{
            $category = Skiller::where('pid', 0)->orderBy('sort', 'desc')->get();
            Cache::forever(config('admin.global.cache.app_skillerList'),$category);
        }

        $data['category'] = $category;
        return response()->json($data);
    }
    /*
     * APP添加技师
     */
    public function add(Request $request){
        $res = $request->all();
        $res['para_id'] = serialize($res['para_id']);
        $skill = Skiller::create($res);

        return response()->json($skill);
    }



}
