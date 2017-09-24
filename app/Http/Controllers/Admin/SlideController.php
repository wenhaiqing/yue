<?php

namespace App\Http\Controllers\Admin;

use App\Models\Picture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\SlideService;
use Cache;

class SlideController extends Controller
{

    protected $service;

    public function __construct(SlideService $service)
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
        $result = Picture::all();
        return view(getThemeView('slide.list'))->with(compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(getThemeView('slide.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = $request ->all();
        for ($i=0;$i<count($res['file']);$i++){
            $path = $this->uploadqiniu($res['file'][$i]);
            $res['path'] = $path;
            $result = $this->service->store($res);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function show(Picture $picture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function edit(Picture $picture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Picture $picture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = $this->service->destroy($id);
        return $res;
    }

    /**
     * 清除分类缓存
     * @author wenhaiqing
     * @date   2017-08-01T11:03:45+0800
     * @return [type]                   [description]
     */
    public function cacheClear()
    {
        Cache::forget(config('admin.global.cache.slideList'));
        flash(trans('common.cache_clear'), 'success')->important();
        return redirect()->route('slide.index');
    }
}
