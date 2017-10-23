@extends('layouts.'.getTheme())
@section('css')
<link href="{{asset(getThemeAssets('iCheck/custom.css', true))}}" rel="stylesheet">
@endsection
@section('content')
@inject('skillerPresenter','App\Presenters\Admin\SkillerPresenter')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>{!!trans('user.title')!!}</h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('admin')}}">{!!trans('home.title')!!}</a>
        </li>
        <li>
            <a href="{{route('user.index')}}">{!!trans('user.title')!!}</a>
        </li>
        <li class="active">
            <strong>{!!trans('common.show').trans('user.slug')!!}</strong>
        </li>
    </ol>
  </div>
  <div class="col-lg-2">
    <div class="title-action">
      <a class="btn btn-white" href="{{route('skiller.index')}}"><i class="fa fa-reply"></i>  {!!trans('common.cancel')!!}</a>
    </div>
  </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>{!!trans('common.show').$skiller->user->phone!!}</h5>
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
              <label class="col-sm-2 control-label">{{trans('skiller.uid')}}</label>
              <div class="col-sm-10">
                <p class="form-control-static">{{$skiller->user->phone}}</p>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('user.username')}}</label>
              <div class="col-sm-10">
                <p class="form-control-static">{{$skiller->cate->name}}</p>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('user.email')}}</label>
              <div class="col-sm-10">
                <p class="form-control-static">{{$skiller->introduce}}</p>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('user.email')}}</label>
              <div class="col-sm-10">
                <p class="form-control-static">{{$skiller->difference}}</p>
              </div>
            </div>


            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <div class="col-sm-4 col-sm-offset-2">
                  <a class="btn btn-white" href="{{route('user.index')}}">{!!trans('common.cancel')!!}</a>
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