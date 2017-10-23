<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\SkillerService;
use App\Models\Skiller;
class SkillerController extends BaseController
{

    protected $service;

    public function __construct(SkillerService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->service->index();
        return request()->ajax() ? $result : view(getThemeView('skiller.list'))->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res = Skiller::all();
        $res = $res->toArray();
        dd($res);
        foreach ($res as $key=>$val){
            foreach ($val as $k=>$v){
                dump($k.'--'.$v);
            }
        }


        $result = $this->service->show($id);
        return view(getThemeView('skiller.show'))->with($result);
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
        return view(getThemeView('skiller.edit'))->with($result);
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
        $route = $this->service->update($request->all(), $id);
        return redirect()->route($route);
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
        return redirect()->route('skiller.index');
    }
}
