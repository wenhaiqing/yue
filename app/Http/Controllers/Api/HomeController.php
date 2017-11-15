<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Picture;
use App\Models\Topline;
use App\Models\Category;
use App\helpers\GeoHash as Geo;
use App\Models\Geohash;
use App\User;
use Cache;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $geo;

    public function __construct(Geo $geoHash)
    {
        $this->geo = $geoHash;
    }


    public function index(){
        if (Cache::has(config('admin.global.cache.toplineList'))) {
            $topline = Cache::get(config('admin.global.cache.toplineList'));
        }else{
            $topline = Topline::all()->toArray();
            Cache::forever(config('admin.global.cache.toplineList'),$topline);
        };
        if (Cache::has(config('admin.global.cache.slideList'))) {
            $slide = Cache::get(config('admin.global.cache.slideList'));
        }else{
            $slide = Picture::where('sid','0')->get()->toArray();
            Cache::forever(config('admin.global.cache.slideList'),$slide);
        }

        if (Cache::has(config('admin.global.cache.app_home_categoryList'))) {
            $category = Cache::get(config('admin.global.cache.app_home_categoryList'));
        }else{
            $category = Category::where('hot', 1)->orderBy('sort', 'desc')->take(9)->get();
            Cache::forever(config('admin.global.cache.app_home_categoryList'),$category);
        }
        
        $data['topline'] = $topline;
        $data['slide'] = $slide;
        $data['category'] = $category;
        return response()->json($data);
    }

    public function test()
    {
//        $data = Geohash::all();
//        foreach ($data as $v){
//            $geohash_val = $this->geo->encode($v['lat'],$v['lon']);
//            Geohash::where('uid',$v['uid'])->update(['geohash' => $geohash_val]);
//        }

        $n_latitude = '37.8440871';
        $n_longitude = '112.542666';

        $b_time = microtime(true);

        $n_geohash = $this->geo->encode($n_latitude,$n_longitude);

        $n = 4;
        $like_geohash = substr($n_geohash, 0, $n);

        $data = Geohash::where('geohash','like','%'.$like_geohash.'%')->get()->toArray();

        foreach($data as $key =>$val) {
            $distance = getDistance($n_latitude, $n_longitude, $val['lat'], $val['lon']);
            $data[$key]['distance'] = $distance;
            //排序列
            $sortdistance[$key] = $distance;
        }
        //距离排序
        array_multisort($sortdistance,SORT_ASC,$data);

        $e_time = microtime(true);

        dd($data);
    }


}
