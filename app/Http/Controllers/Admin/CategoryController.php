<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\CategoryService;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Models\Norm;
use App\Models\Para;
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
        $res['norms'] = serialize($res['norms']);
        if($res['file']){
            $path = $this->uploadqiniu($res['file']);
            if($path){
                $res['url'] = $path;
            }
        }
        $result = $this->service->store($res);
        $cateid = $result['status']->id;
        $norms = $request->norms;
        $nodata['cate_id'] = $cateid;
        for($i=0;$i<count($norms);$i++){
            if($norms[$i]['norm']){
                $nodata['title'] = $norms[$i]['norm'];
                $normres = Norm::create($nodata);
                $padata['norm_id'] = $normres->id;
                for($j=0;$j<count($norms[$i]['para']);$j++){
                    if($norms[$i]['para'][$j]){
                        $padata['name'] = $norms[$i]['para'][$j];
                        $parares = Para::create($padata);
                    }
                }
            }
        }

        flash(trans($result['message']), 'success')->important();
        
        return redirect()->route('category.index');
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
        $res = $result['category']->toArray();
        $norms = unserialize($res['norms']);
        $result['norms'] = $norms;
        //dd($result);
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
        $res = $request ->all();
        $res['norms'] = serialize($res['norms']);
        $result = $this->service->update($res, $id);
        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_)
    {
        $id = decodeId($id_, 'category');
        $path = Category::find($id)->toArray();
        $file = str_replace(config('filesystems.disks.qiniu.qiniuhttp'),'',$path['url']);
        $res = $this->service->destroy($id_);
        if($res){
            $result = $this->deleteqiniu($file);
        }
        flash_info($res,trans('common.destroy_success'),trans('common.destroy_error'));
        return redirect()->route('category.index');
    }
    /**
     * 清除分类缓存
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
