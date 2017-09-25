<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Picture;
use App\Models\Topline;
use App\Models\Category;
use Cache;

class HomeController extends Controller
{
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
            $slide = Picture::all()->toArray();
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
}
