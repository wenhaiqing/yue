<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Topline;
use Cache;
class ToplineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Cache::has(config('admin.global.cache.toplineList'))) {
            $result = Cache::get(config('admin.global.cache.toplineList'));
        }else{
            $result = Topline::all()->toArray();
            Cache::forever(config('admin.global.cache.toplineList'),$result);
        }
        return view(getThemeView('topline.list'))->with(compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = Topline::create($request->all());
        if($res){
            Cache::forget(config('admin.global.cache.toplineList'));
            flash(trans('common.create_success'), 'success')->important();
        }else{
            flash(trans('common.create_error'), 'error')->important();
        }
        return redirect()->route('topline.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Topline::destroy($id);
        if($res){
            Cache::forget(config('admin.global.cache.toplineList'));
            return [
                'status' => 0,
                'msg' => $res ? trans('common.destroy_success'):trans('common.destroy_error'),
            ];

        }else{
            return [
                'status' => 1,
                'msg' => trans('common.destroy_error'),
            ];
        }

    }

    /**
     * 清除缓存
     * @author wenhaiqing
     * @date   2017-08-01T11:03:45+0800
     * @return [type]                   [description]
     */
    public function cacheClear()
    {
        Cache::forget(config('admin.global.cache.toplineList'));
        flash(trans('common.cache_clear'), 'success')->important();
        return redirect()->route('topline.index');
    }
}
