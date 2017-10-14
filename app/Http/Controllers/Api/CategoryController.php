<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Cache;

class CategoryController extends Controller
{
    /*
     * APP分类列表页的顶级菜单
     */
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
    /*
     * APP分类列表页的顶级分类下的子菜单
     */
    public function getCategorySon(Request $request){
        $res = $request->all();
        $id = $res['id'];
        $category = Category::where('pid', $id)->orderBy('sort', 'desc')->get();

        $data['category'] = $category;
        return response()->json($data);
    }

    /*
     * app发布技能需要获取的分类详情
     */
    public function getcategoryware(Request $request){
        $res = $request->all();
        $id = $res['id'];
        $category = Category::with(['norm.para'])->find($id);
        $data['category'] = $category;

        return response()->json($data);
    }


}
