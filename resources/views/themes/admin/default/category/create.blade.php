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
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('category.norms')}}</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" value="" placeholder="例如:自驾分类的车辆来源,车辆类型，这里只能填单个" name="norms[0]['norm']">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('category.norms_para')}}</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" value="" placeholder="例如:车辆类型有轿车，越野车，这里多个用英文逗号分隔" name="norms[0]['para']">
        </div>
      </div>
      @for ($i = 1; $i < 10; $i++)
        <div id="norms_{{$i}}" style="display:none">
        <div class="hr-line-dashed"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">{{trans('category.norms')}}{{$i}}</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="" placeholder="例如:自驾分类的车辆来源,车辆类型，这里只能填单个" name="norms[{{$i}}]['norm']">
          </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">{{trans('category.norms_para')}}{{$i}}</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="" placeholder="例如:车辆类型有轿车，越野车，这里多个用英文逗号分隔" name="norms[{{$i}}]['para']">
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
  var set_begin_num = 1;

  $('#bt_add_keyword').click(function(){

    $('#norms_' + set_begin_num).show();

    if (set_begin_num >= 10) {

      $('#bt_add_keyword').hide();

    }

    set_begin_num++;

  });
</script>