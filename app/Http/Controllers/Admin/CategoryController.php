<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\CategoryService;
use App\Http\Requests\Admin\CategoryRequest;
use zgldh\QiniuStorage\QiniuStorage;
class CategoryController extends BaseController
{

    protected $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->service->getCategoryList();
        return view(getThemeView('category.list'))->with(compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result = $this->service->create();
        return view(getThemeView('category.create'))->with($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $res = $request ->all();
        $path = $this->uploadqiniu($res);
        if($path){
            $res['url'] = $path;
        }
        $result = $this->service->store($res);
        return response()->json($result);
    }

    /**
     * 上传图片到七牛
     * @author wenhaiqing
     * @return bool
     */
    public function uploadqiniu($request){

            // 获取文件,file对应的是前端表单上传input的name
            $file = $request['file'];
        if ($file) {

            // Laravel5.3中多了一个写法
            // $file = $request->file;

            // 初始化
            $disk = QiniuStorage::disk('qiniu');
            // 重命名文件
            $fileName = md5($file->getClientOriginalName().time().rand()).'.'.$file->getClientOriginalExtension();

            // 上传到七牛
            $bool = $disk->put('wenhaiqing/image_'.$fileName,file_get_contents($file->getRealPath()));
            // 判断是否上传成功
            if ($bool) {
                $path = $disk->downloadUrl('wenhaiqing/image_'.$fileName);
                return $path;
            }
            return false;
        }
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->service->show($id);
        return view(getThemeView('category.show'))->with($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = $this->service->edit($id);
        return view(getThemeView('category.edit'))->with($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $result = $this->service->update($request->all(), $id);
        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->destroy($id);
        return redirect()->route('category.index');
    }
    /**
     * 清除菜单缓存
     * @author wenhaiqing
     * @date   2017-08-01T11:03:45+0800
     * @return [type]                   [description]
     */
    public function cacheClear()
    {
        $this->service->cacheClear();
        return redirect()->route('category.index');
    }
}
