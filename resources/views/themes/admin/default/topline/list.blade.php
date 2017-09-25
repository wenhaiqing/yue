@extends('layouts.'.getTheme())
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset(getThemeAssets('nestable/nestable.css', true))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(getThemeAssets('bootstrap-select/bootstrap-select.min.css', true))}}">
    <link href="{{asset(getThemeAssets('ionRangeSlider/ion.rangeSlider.css', true))}}" rel="stylesheet">
    <link href="{{asset(getThemeAssets('ionRangeSlider/ion.rangeSlider.skinFlat.css', true))}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset(getThemeAssets('ladda/ladda-themeless.min.css', true))}}">

@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{!!trans('topline.title')!!}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('admin')}}">{!!trans('home.title')!!}</a>
                </li>
                <li class="active">
                    <strong>{!!trans('topline.title')!!}</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <div class="title-action">
                @if(haspermission('toplinecontroller.cacheclear'))
                    <a href="{{url('admin/topline/clear')}}" class="btn btn-info"><i class="fa fa-cancel"></i>
                        {{trans('topline.cache_clear')}}
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
                        <h5>{!!trans('topline.list')!!}</h5>
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
                                <th>头条内容</th>
                                <th>排序</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=0;$i<count($result);$i++)
                                <tr>
                                <td>{{$result[$i]['id']}}</td>
                                <td>{{$result[$i]['content']}}</td>
                                <td>{{$result[$i]['sort']}}</td>
                                <td><a href="javascript:;" onclick="deltopline({{$result[$i]['id']}})"><i class="fa fa-times text-navy"></i></a></td>
                                </tr>
                            @endfor
                            {{--@foreach ($result as $res)--}}
                                {{--<tr>--}}
                                    {{--<td>{{$res->id}}</td>--}}
                                    {{--<td>{{$res->content}}</td>--}}
                                    {{--<td>{{$res->sort}}</td>--}}
                                    {{--<td><a href="javascript:;" onclick="deltopline({{$res->id}})"><i class="fa fa-times text-navy"></i></a></td>--}}
                                {{--</tr>--}}
                            {{--@endforeach--}}
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{!!trans('topline.create')!!}</h5>
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
                        <form method="post" action="{{route('topline.store')}}" class="form-horizontal">
                            {!!csrf_field()!!}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('topline.content')}}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="{{trans('topline.content')}}" name="content">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('topline.sort')}}</label>
                                <div class="col-sm-10">
                                    <input type="text" id="sort"  name='sort' class="form-control"/>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-white close-link">{!!trans('common.close')!!}</a>
                                    <button class="btn btn-primary createButton ladda-button"  data-style="zoom-in">{!!trans('topline.create')!!}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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

    <script type="text/javascript">
        $('#sort').ionRangeSlider({
            type: "single",
            min: 0,
            max: 100,
            from: 0
        });

        function deltopline(link_id) {
            layer.confirm('您确定要删除这个链接吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/topline/')}}/"+link_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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