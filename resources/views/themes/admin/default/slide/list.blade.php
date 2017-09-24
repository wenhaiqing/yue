@extends('layouts.'.getTheme())
@section('css')

    <link href="{{asset(getThemeAssets('dropzone/dropzone.css', true))}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset(getThemeAssets('dropzone/basic.css', true))}}">
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{!!trans('slide.title')!!}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('admin')}}">{!!trans('home.title')!!}</a>
                </li>
                <li class="active">
                    <strong>{!!trans('slide.title')!!}</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <div class="title-action">
                @if(haspermission('slidecontroller.cacheclear'))
                    <a href="{{url('admin/slide/clear')}}" class="btn btn-info"><i class="fa fa-cancel"></i>
                        {{trans('slide.cache_clear')}}
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeIn">

        <div class="row">
            @include('flash::message')
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{!!trans('slide.list')!!}</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>图片</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($result as $res)
                                <tr>
                                    <td>{{$res->id}}</td>
                                    <td><img style="height:50px;" src="{{$res->path}}"></td>
                                    <td><a href="javascript:;" onclick="delSlide({{$res->id}})"><i class="fa fa-times text-navy"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{!!trans('slide.create')!!}</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form id="my-awesome-dropzone" class="dropzone" action="#">
                            {!!csrf_field()!!}
                            <div class="dropzone-previews"></div>
                            <button type="submit" class="btn btn-primary pull-right">Submit this form!</button>
                        </form>
                        <div>
                            <div class="m text-right"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')

    <script src="{{asset(getThemeAssets('pace/pace.min.js', true))}}"></script>
    <script src="{{asset(getThemeAssets('dropzone/dropzone.js', true))}}"></script>
    <script src="{{asset(getThemeAssets('layer/layer.js', true))}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            Dropzone.options.myAwesomeDropzone = {
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 100,

                // Dropzone settings
                init: function() {
                    var myDropzone = this;

                    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
                    });
                    this.on("sendingmultiple", function() {
                    });
                    this.on("successmultiple", function(files, response) {
                    });
                    this.on("errormultiple", function(files, response) {
                    });
                }
            }
        });

        function delSlide(link_id) {
            layer.confirm('您确定要删除这个链接吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/slide/')}}/"+link_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                    if(data.status==0){
                        location.href = location.href;
                        layer.msg(data.msg, {icon: 6});
                    }else{
                        layer.msg(data.msg, {icon: 5});
                    }
                });
//            layer.msg('的确很重要', {icon: 1});
            }, function(){
            });
        }
    </script>
@endsection