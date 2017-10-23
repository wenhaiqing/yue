@extends('layouts.'.getTheme())
@section('css')
<link href="{{asset(getThemeAssets('iCheck/custom.css', true))}}" rel="stylesheet">
@endsection
@section('content')
@inject('demandPresenter','App\Presenters\Admin\DemandPresenter')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>{!!trans('demand.title')!!}</h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('admin')}}">{!!trans('home.title')!!}</a>
        </li>
        <li>
            <a href="{{route('demand.index')}}">{!!trans('demand.title')!!}</a>
        </li>
        <li class="active">
            <strong>{!!trans('common.show').trans('user.slug')!!}</strong>
        </li>
    </ol>
  </div>
  <div class="col-lg-2">
    <div class="title-action">
      <a class="btn btn-white" href="{{route('demand.index')}}"><i class="fa fa-reply"></i>  {!!trans('common.cancel')!!}</a>
    </div>
  </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>{!!trans('common.show').$demand->user->phone!!}</h5>
          <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
              <a class="close-link">
                  <i class="fa fa-times"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
          <form class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('demand.phone')}}</label>
              <div class="col-sm-10">
                <p class="form-control-static">{{$demand->user->phone}}</p>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('demand.cate_name')}}</label>
              <div class="col-sm-10">
                <p class="form-control-static">{{$demand->cate->name}}</p>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('demand.yuetime')}}</label>
              <div class="col-sm-10">
                <p class="form-control-static">{{$demand->yuetime}}</p>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('demand.validday')}}</label>
              <div class="col-sm-10">
                <p class="form-control-static">{{$demand->difference}}天</p>
              </div>
            </div>
              <div class="hr-line-dashed"></div>
              <div class="form-group">
                  <label class="col-sm-2 control-label">{{trans('demand.needpara')}}</label>
                  <div class="col-sm-10">
                      <p class="form-control-static">{{$demand->needpara}}</p>
                  </div>
              </div>
              <div class="hr-line-dashed"></div>
              <div class="form-group">
                  <label class="col-sm-2 control-label">{{trans('demand.sincerity')}}</label>
                  <div class="col-sm-10">
                      <p class="form-control-static">{{$demand->sincerity}}</p>
                  </div>
              </div>
              <div class="hr-line-dashed"></div>
              <div class="form-group">
                  <label class="col-sm-2 control-label">{{trans('demand.para')}}</label>
                  <div class="col-sm-10">
                      <div class="ibox float-e-margins">
                          <table class="table table-bordered">
                              <thead>
                              <tr>
                                  <th class="col-md-1 text-center">{{trans('demand.para_id')}}</th>
                                  <th class="col-md-10 text-center">{{trans('demand.para')}}</th>
                              </tr>
                              </thead>
                              <tbody>
                              {!! $demandPresenter->showUserPara($demand->para_id) !!}
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>


            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <div class="col-sm-4 col-sm-offset-2">
                  <a class="btn btn-white" href="{{route('demand.index')}}">{!!trans('common.cancel')!!}</a>
              </div>
            </div>
          </form>
        </div>
    </div>
  	</div>
  </div>
</div>
@include(getThemeView('user.modal'))
@endsection
@section('js')
<script type="text/javascript" src="{{asset(getThemeAssets('iCheck/icheck.min.js', true))}}"></script>
<script type="text/javascript" src="{{asset(getThemeAssets('js/check.js'))}}"></script>
@endsection