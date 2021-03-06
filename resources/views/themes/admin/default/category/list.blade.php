@extends('layouts.'.getTheme())
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset(getThemeAssets('nestable/nestable.css', true))}}">
<link rel="stylesheet" type="text/css" href="{{asset(getThemeAssets('bootstrap-select/bootstrap-select.min.css', true))}}">
<link href="{{asset(getThemeAssets('ionRangeSlider/ion.rangeSlider.css', true))}}" rel="stylesheet">
<link href="{{asset(getThemeAssets('ionRangeSlider/ion.rangeSlider.skinFlat.css', true))}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset(getThemeAssets('ladda/ladda-themeless.min.css', true))}}">
@endsection
@section('content')
@inject('categoryPreseter','App\Presenters\Admin\CategoryPresenter')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>{!!trans('category.title')!!}</h2>
    <ol class="breadcrumb">
      <li>
            <a href="{{url('admin')}}">{!!trans('home.title')!!}</a>
        </li>
        <li class="active">
            <strong>{!!trans('category.title')!!}</strong>
        </li>
    </ol>
  </div>
  <div class="col-lg-2">
    <div class="title-action">
      @if(haspermission('categorycontroller.cacheclear'))
      <a href="{{url('admin/category/clear')}}" class="btn btn-info"><i class="fa fa-cancel"></i>
        {{trans('category.cache_clear')}}
      </a>
      @endif
    </div>
  </div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight">
  <div class="row">
    @include('flash::message')
    <div class="col-lg-6">
      <div class="ibox animated fadeInRightBig">
        <div class="ibox-title">
            <h5>{!!trans('category.desc')!!}</h5>

        </div>

        <div class="ibox-content">
          <div class="dd" id="nestable">
            <ol class="dd-list">
              {!!$categoryPreseter->categoryNestable($categories)!!}
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 menuBox">
      {!!$categoryPreseter->canCreateCategory()!!}
    </div>
  </div>
</div>
@endsection
@section('js')
<script src="{{asset(getThemeAssets('nestable/jquery.nestable.js', true))}}"></script>
<script src="{{asset(getThemeAssets('bootstrap-select/bootstrap-select.min.js', true))}}"></script>
<script src="{{asset(getThemeAssets('ionRangeSlider/ion.rangeSlider.min.js', true))}}"></script>
<script src="{{asset(getThemeAssets('ladda/spin.min.js', true))}}"></script>
<script src="{{asset(getThemeAssets('ladda/ladda.min.js', true))}}"></script>
<script src="{{asset(getThemeAssets('ladda/ladda.jquery.min.js', true))}}"></script>
<script src="{{asset(getThemeAssets('layer/layer.js', true))}}"></script>
<script src="{{asset(getThemeAssets('js/category.js'))}}"></script>
<script type="text/javascript">
  $('#nestable').on('click','.destroy_item',function() {
    var _item = $(this);
    var title = "{{trans('common.deleteTitle').trans('category.desc')}}？";
    layer.confirm(title, {
      btn: ['{{trans('common.yes')}}', '{{trans('common.no')}}'],
      icon: 5
    },function(index){
      _item.children('form').submit();
      layer.close(index);
    });
  });
</script>
@endsection