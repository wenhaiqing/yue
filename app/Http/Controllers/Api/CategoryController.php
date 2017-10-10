<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Cache;

class CategoryController extends Controller
{
    public function index(){
        if (Cache::has(config('admin.global.cache.app_topcategory_categoryList'))) {
            $category = Cache::get(config('admin.global.cache.app_topcategory_categoryList'));
        }else{
            $category = Category::where('pid', 0)->orderBy('sort', 'desc')->get();
            Cache::forever(config('admin.global.cache.app_topcategory_categoryList'),$category);
        }

        $data['category'] = $category;
        return response()->json($data);
    }
}
