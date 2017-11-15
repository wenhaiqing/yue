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
            $slide = Picture::where('sid','0')->all()->toArray();
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

        $n_latitude = '39.915';
        $n_longitude = '116.404';

        $b_time = microtime(true);

        $n_geohash = $this->geo->encode($n_latitude,$n_longitude);

        $n = 6;
        $like_geohash = substr($n_geohash, 0, $n);

        $res = Geohash::where('geohash','like','%'.$like_geohash.'%')->all();
        dd($res);
        $e_time = microtime(true);
        dump($e_time - $b_time);
        dd($res);
    }

    public function getDistance($lat1, $lng1, $lat2, $lng2) {
        //地球半径
        $R = 6378137;
        //将角度转为狐度
        $radLat1 = deg2rad($lat1);
        $radLat2 = deg2rad($lat2);
        $radLng1 = deg2rad($lng1);
        $radLng2 = deg2rad($lng2);
        //结果
        $s = acos(cos($radLat1)*cos($radLat2)*cos($radLng1-$radLng2)+sin($radLat1)*sin($radLat2))*$R;
        //精度
        $s = round($s* 10000)/10000;
        return  round($s);
    }

}
