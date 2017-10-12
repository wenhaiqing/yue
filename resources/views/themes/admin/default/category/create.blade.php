@inject('categoryPresenter','App\Presenters\Admin\CategoryPresenter')
<div class="ibox float-e-margins animated bounceIn formBox" id="createBox">
  <div class="ibox-title">
    <h5>{{trans('common.create').trans('category.desc')}}</h5>
    <div class="ibox-tools">
      <a class="close-link">
          <i class="fa fa-times"></i>
      </a>
    </div>
  </div>
  <div class="ibox-content">
    <form method="post" action="{{route('category.store')}}" class="form-horizontal" enctype="multipart/form-data">
      {!!csrf_field()!!}
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('category.name')}}</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="{{trans('category.name')}}" name="name">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('category.pid')}}</label>
        <div class="col-sm-10">
          <select data-placeholder="{{trans('category.pid')}}" data-live-search="true" class="selectpicker form-control" name="pid">
            {!!$categoryPresenter->topCategoryList($Categories)!!}
          </select>
        </div>
      </div>

      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('category.hot')}}</label>
        <div class="col-sm-10">
          <select data-placeholder="{{trans('category.hot')}}" data-live-search="true" class="selectpicker form-control" name="hot">
              <option value="0">否</option>
              <option value="1">是</option>
          </select>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">上传分类图片</label>
        <div class="col-sm-10">
          <input type="file" name="file">
        </div>
      </div>
      @for ($i = 0; $i < 10; $i++)
        <div id="norms_{{$i}}" style="display:none">
        <div class="hr-line-dashed"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">{{trans('category.norms')}}{{$i}}</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="" placeholder="例如:自驾分类的车辆来源,车辆类型，这里只能填单个" name="norms[{{$i}}][norm]">
          </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">{{trans('category.norms_para')}}{{$i}}</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" value="" placeholder="" name="norms[{{$i}}][para][]">
          </div>
          @for ($j = 1; $j < 10; $j++)
            <div id="paras_{{$i}}_{{$j}}" class="paras_{{$i}}" style="display:none">
                <div class="col-sm-2">
                  <input type="text" class="form-control" value="" placeholder="" name="norms[{{$i}}][para][]">
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
        <label class="col-sm-2 control-label">{{trans('category.sort')}}</label>
        <div class="col-sm-10">
          <input type="text" id="sort"  name='sort' class="form-control"/>
        </div>
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
  $('.selectpicker').selectpicker();
  $('#sort').ionRangeSlider({
      type: "single",
      min: 0,
      max: 100,
      from: 0
  });
  var set_begin_num = 0;

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