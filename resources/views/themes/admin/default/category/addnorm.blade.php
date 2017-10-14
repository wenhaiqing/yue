@inject('categoryPresenter','App\Presenters\Admin\CategoryPresenter')
<div class="ibox float-e-margins animated bounceIn formBox" id="createBox">
  <div class="ibox-title">
    <h5>{{trans('category.addnorm')}}</h5>
    <div class="ibox-tools">
      <a class="close-link">
          <i class="fa fa-times"></i>
      </a>
    </div>
  </div>
  <div class="ibox-content">
    <form method="post" action="{{url('admin/category/addnormstore')}}" class="form-horizontal" enctype="multipart/form-data">
      {!!csrf_field()!!}
      @for ($i = 0; $i < count($res); $i++)
        <div id="norms_{{$i}}">
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <label class="col-sm-2 control-label">{{trans('category.norms')}}{{$i}}</label>
            <div class="col-sm-10">
              <input type="hidden" name="norms[{{$i}}][id]" value="{{$res[$i]['id']}}">
              <input type="text" class="form-control" value="{{$res[$i]['title']}}" placeholder="" name="norms[{{$i}}][norm]">
            </div>
          </div>
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <label class="col-sm-2 control-label">{{trans('category.norms_para')}}{{$i}}</label>
            @for($j=0;$j< count($res[$i]['para']);$j++)
              <div class="col-sm-2">
                <input type="hidden" value="{{$res[$i]['para'][$j]['id']}}" name="norms[{{$i}}][para][{{$j}}][id]">
                <input type="text" class="form-control" value="{{$res[$i]['para'][$j]['name']}}" placeholder="" name="norms[{{$i}}][para][{{$j}}][para]">
              </div>
            @endfor
            @for($j=count($res[$i]['para']);$j<10;$j++)
              <div id="paras_{{$i}}_{{$j}}" class="paras_{{$i}}" style="display:none">
                <div class="col-sm-2">
                  <input type="hidden" value="" name="norms[{{$i}}][para][{{$j}}][id]">
                  <input type="text" class="form-control" value="" placeholder="" name="norms[{{$i}}][para][{{$j}}][para]">
                </div>
              </div>
            @endfor
            <div class="col-sm-1">
              <button id="btn_add_normpara{{$i}}" onclick="showpara('{{$i}}');" type="button" class="btn btn-warning">
                <span class="glyphicon glyphicon-plus"></span>
              </button>
            </div>
          </div>
        </div>
      @endfor
      @for ($i = count($res); $i < 10; $i++)
        <div id="norms_{{$i}}" style="display:none">
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <label class="col-sm-2 control-label">{{trans('category.norms')}}{{$i}}</label>
            <div class="col-sm-10">
              <input type="hidden" name="norms[{{$i}}][id]" value="">
              <input type="text" class="form-control" value="" placeholder="例如:自驾分类的车辆来源,车辆类型，这里只能填单个" name="norms[{{$i}}][norm]">
            </div>
          </div>
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <label class="col-sm-2 control-label">{{trans('category.norms_para')}}{{$i}}</label>
            <div class="col-sm-2">
              <input type="hidden" value="" name="norms[{{$i}}][para][0][id]">
              <input type="text" class="form-control" value="" placeholder="" name="norms[{{$i}}][para][0][para]">
            </div>
            @for ($j = 1; $j < 10; $j++)
              <div id="paras_{{$i}}_{{$j}}" class="paras_{{$i}}" style="display:none">
                <div class="col-sm-2">
                  <input type="hidden" value="" name="norms[{{$i}}][para][{{$j}}][id]">
                  <input type="text" class="form-control" value="" placeholder="" name="norms[{{$i}}][para][{{$j}}][para]">
                </div>
              </div>
            @endfor
            <div class="col-sm-1">
              <button id="btn_add_normpara{{$i}}" onclick="showpara('{{$i}}');" type="button" class="btn btn-warning">
                <span class="glyphicon glyphicon-plus"></span>
              </button>
            </div>
          </div>
        </div>
      @endfor
      <div class="col-sm-4 col-sm-offset-2">
        <button id="bt_add_keyword" type="button" class="btn btn-warning">
          <span class="glyphicon glyphicon-plus"></span> 添加分类规格
        </button>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
          <div class="col-sm-4 col-sm-offset-2">
            <a class="btn btn-white close-link">{!!trans('common.close')!!}</a>
            <button type="submit"  data-style="zoom-in">{!!trans('category.create')!!}</button>
          </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">

  var set_begin_num = {{count($res)}};

  $('#bt_add_keyword').click(function(){

    $('#norms_' + set_begin_num).show();

    if (set_begin_num >= 10) {

      $('#bt_add_keyword').hide();

    }

    set_begin_num++;

  });
  function showpara(i) {
    $(".paras_"+i).each(function(){
      //判断每一个div，其css中display是否为block
      if($(this).css("display")=="none"){
        $(this).show();return false;
      }
    });
  }

</script>